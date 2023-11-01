<template>
    <div class="wrapper">
        <div class="d-md-flex align-items-md-center">
            <div class="h3">Book Store</div>
        </div>
        <div class="d-lg-flex align-items-lg-center pt-2">
            <div class="form-inline d-flex align-items-center my-2 mr-lg-2 radio bg-light border">
                <input class="bg-light border-0" v-model="searchQueryTitle" placeholder="Search by title" @input="fetchFilteredBooks" />
            </div>

            <div class="form-inline d-flex align-items-center my-2 checkbox bg-light border mx-lg-2">
                <select name="author" id="author" class="drowpdown bg-light" v-model="searchQueryAuthor" @change="fetchFilteredBooks">
                    <option value="">-- Author --</option>
                    <option v-for="author in bookDropdownData.authors">{{author}}</option>
                </select>
            </div>

            <div class="form-inline d-flex align-items-center my-2 checkbox bg-light border mx-lg-2">
                <select name="publisher" id="publisher" class="drowpdown bg-light" v-model="searchQueryPublisher" @change="fetchFilteredBooks">
                    <option value="">-- Publisher --</option>
                    <option v-for="publisher in bookDropdownData.publishers">{{publisher}}</option>
                </select>
            </div>

            <div class="form-inline d-flex align-items-center my-2 checkbox bg-light border mx-lg-2">
                <select name="genre" id="genre" class="drowpdown bg-light" v-model="searchQueryGenre" @change="fetchFilteredBooks">
                    <option value="">-- Genre --</option>
                    <option v-for="genre in bookDropdownData.genre">{{genre}}</option>
                </select>
            </div>

            <div class="form-inline d-flex align-items-center my-2 checkbox bg-light border mx-lg-2">
                <select name="isbn" id="isbn" class="drowpdown bg-light" v-model="searchQueryIsbn" @change="fetchFilteredBooks">
                    <option value="">-- isbn --</option>
                    <option v-for="isbn in bookDropdownData.isbn">{{isbn}}</option>
                </select>
            </div>
        </div>
        <div class="content py-md-0 py-3">
            <!-- Products Section -->
            <section id="products">
                <div class="container py-3">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 pt-md-4 pt-4" v-if="!filteredBooks.data.length">
                            <h3>No data found</h3>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 pt-md-4 pt-4" v-for="book in filteredBooks.data" :key="book.id">
                            <div class="card">
                                <img class="card-img-top" :src="book.image_url"/>
                                <div class="card-body">
                                    <h6 class="font-weight-bold pt-1">
                                        {{ book.title }}
                                    </h6>
                                    <div class="text-muted description">
                                        {{ book.description }}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between pt-3">
                                        <div class="d-flex flex-column">
                                            <div class="h6 font-weight-bold">
                                                {{ book.author }}
                                            </div>
                                        </div>
                                        <div class="btn green-label">
                                            {{ book.genre }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <nav aria-label="Page navigation" v-if="currentPage.length">
                    <ul class="pagination">
                    <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                        <a class="page-link" @click="goToPage(currentPage - 1)" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <!-- Display the first page
                    <li class="page-item" :class="{ 'active': currentPage === 1 }" v-if="currentPage !== 1">
                        <a class="page-link" @click="goToPage(1)" href="#">1</a>
                    </li> -->

                    <!-- Display ellipsis if there are more than 7 pages before the current page -->
                    <li v-if="currentPage > 4" class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>

                    <!-- Display 6 pages before the current page (or all available if less than 6) -->
                    <li v-for="page in Math.min(currentPage - 1, 6)" :key="page" class="page-item">
                        <a class="page-link" @click="goToPage(page)" href="#">{{ page }}</a>
                    </li>

                    <!-- Display the current page -->
                    <li class="page-item" v-if="currentPage != totalPages" :class="{ 'active': currentPage > 0 && currentPage < totalPages }">
                        <a class="page-link" @click="goToPage(currentPage)" href="#">{{ currentPage }}</a>
                    </li>

                    <!-- Display 6 pages after the current page (or all available if less than 6) -->
                    <li v-for="page in Math.min(totalPages - currentPage, 6)" :key="page" class="page-item">
                        <a class="page-link" @click="goToPage(currentPage + page)" href="#">{{ currentPage + page }}</a>
                    </li>

                    <!-- Display ellipsis if there are more than 7 pages after the current page -->
                    <li v-if="totalPages - currentPage > 6" class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>

                    <!-- Display the last page -->
                    <li class="page-item" :class="{ 'active': currentPage === totalPages }">
                        <a class="page-link" @click="goToPage(totalPages)" href="#">{{ totalPages }}</a>
                    </li>

                    <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                        <a class="page-link" @click="goToPage(currentPage + 1)" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    </ul>
                </nav>
            </section>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            filteredBooks: {
                data: [],
                current_page: 1,
                last_page: 1,
            },
            bookDropdownData: {},
            searchQueryTitle: "",
            searchQueryAuthor: "",
            searchQueryGenre: "",
            searchQueryIsbn: "",
            searchQueryPublisher: "",
            dateFilter: null,
        };
    },
    mounted() {
        this.fetchFilteredBooks();
        this.fetchBooksDropdown();
    },
    computed: {
        currentPage() {
            return this.filteredBooks.current_page;
        },
        totalPages() {
            return this.filteredBooks.last_page;
        },
    },
    methods: {
        async fetchFilteredBooks() {
            try {
                const response = await axios.get("/api/books", {
                    params: {
                        title: this.searchQueryTitle,
                        author: this.searchQueryAuthor,
                        isbn: this.searchQueryIsbn,
                        genre: this.searchQueryGenre,
                        publisher: this.searchQueryPublisher,
                        page: this.currentPage,
                    },
                });
                this.filteredBooks = response.data;
            } catch (error) {
                console.error("Error fetching filtered book data: ", error);
            }
        },

        async fetchBooksDropdown() {
            try {
                const response = await axios.get("/api/books/getDropdownData", {
                    params: {
                        title: this.searchQueryTitle,
                        isbn: this.searchQueryIsbn,
                        publisher: this.searchQueryPublisher,
                        page: this.currentPage,
                    },
                });
                this.bookDropdownData = response.data;
            } catch (error) {
                console.error("Error fetching filtered book data: ", error);
            }
        },

        goToPage(page) {
            if (page < 1) {
                page = 1;
            } else if (page > this.totalPages) {
                page = this.totalPages;
            }
            this.filteredBooks.current_page = page;
            this.fetchFilteredBooks();
        },
    },
};
</script>

<style scoped>
/* Add your CSS styles here */
textarea:focus, input:focus{
    outline: none;
}
.card-img-top {
    height: auto;
}
</style>
