<template>
    <nav>
        <ul class="pagination">
            <li v-if="pagination.current_page > 1">
                <a href="javascript:void(0)" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <li v-for="page in pagesNumber" :class="{'active': page == pagination.current_page}">
                <a href="javascript:void(0)" v-on:click.prevent="changePage(page)">{{ page }}</a>
            </li>
            <li v-if="pagination.current_page < pagination.last_page">
                <a href="javascript:void(0)" aria-label="Next" v-on:click.prevent="changePage(pagination.current_page + 1)">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<style scoped>
    .pagination {
        display: flex;
        list-style: none;
        justify-content: center;
    }
</style>

<script>
    export default{
        props: {
            pagination: {
                type: Object,
                required: true
            },
            eachSide: {
                type: Number,
                default: 5,
                required: false
            }
        },
        computed: {
            pagesNumber() {
                let pagesArray = [];
                let firstPage = 1;
                let lastPage = this.pagination.last_page;
                
                if (this.eachSide !== '') {
                    if (this.pagination.current_page - this.eachSide > firstPage) {
                        firstPage = this.pagination.current_page - this.eachSide
                    }
                    if (this.eachSide + this.pagination.current_page < lastPage) {
                        lastPage = this.eachSide + this.pagination.current_page
                    }
                }
                if (firstPage !== 1) {
                    pagesArray.push(1);
                }
                for (let page = firstPage; page <= lastPage; page++) {
                    pagesArray.push(page);
                }
                if (lastPage !== this.pagination.last_page) {
                    pagesArray.push(this.pagination.last_page);
                }
                return pagesArray;
            }
        },
        methods: {
            changePage ( page ) {
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        }
    }
</script>