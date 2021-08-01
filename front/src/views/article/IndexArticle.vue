<template>
    <b-card
        no-body
        header-tag="header"
        footer-tag="footer"
    >
        <template v-slot:header>
            <div class="d-flex justify-content-between py-1">
                <h3 class="mb-0">Articles</h3>
                <router-link :to="{name: 'createArticle'}">
                    <b-button>{{ $t('COMMON.TABLE.add') }}</b-button>
                </router-link>
            </div>
        </template>

        <b-table
            ref="refListTable"
            :items="fetchItems"
            show-empty
            :empty-text="$t('COMMON.TABLE.data-empty')"
            responsive="sm"
            no-local-sorting
            :fields="tableColumn"
            :sort-by.sync="table.sortBy"
            :sort-desc.sync="table.isSortDirDesc"
            primary-key="id"
            class="table table-hover m-0 position-relative"
        >
            <!-- Column: Actions -->
            <template #cell(actions)="data">
                <b-dropdown
                    variant="link"
                    toggle-class="p-0"
                    no-caret
                >
                    <template #button-content>
                        <feather-icon
                            icon="MoreVerticalIcon"
                            size="16"
                            class="align-middle text-body"
                        />
                    </template>
                    <b-dropdown-item :to="{ name: 'updateArticle', params: { id: data.item.id } }">
                        <feather-icon icon="EditIcon" />
                        <span class="align-middle ml-1">{{ $t('BUTTONS.change') }}</span>
                    </b-dropdown-item>

                    <b-dropdown-item @click="deleteItem(data.item.id)">
                        <feather-icon icon="TrashIcon" />
                        <span class="align-middle ml-1">{{ $t('BUTTONS.delete') }}</span>
                    </b-dropdown-item>
                </b-dropdown>
            </template>

        </b-table>

        <template v-slot:footer>
            <div class="mx-2 mb-2">
                <b-row>
                    <b-col
                        cols="12"
                        sm="6"
                        class="d-flex align-items-center justify-content-center justify-content-sm-start"
                    >
                        <span class="text-muted">{{ $t('COMMON.TABLE.showing-from-to', {from: dataMeta.from, to: dataMeta.to, count: dataMeta.of}) }}</span>
                    </b-col>
                    <!-- Pagination -->
                    <b-col
                        cols="12"
                        sm="6"
                        class="d-flex align-items-center justify-content-center justify-content-sm-end"
                    >
                        <b-pagination
                            v-model="table.currentPage"
                            :total-rows="table.total"
                            :per-page="table.perPage"
                            first-number
                            last-number
                            class="mb-0 mt-1 mt-sm-0"
                            prev-class="prev-item"
                            next-class="next-item"
                        >
                            <template #prev-text>
                                <feather-icon
                                    icon="ChevronLeftIcon"
                                    size="18"
                                />
                            </template>
                            <template #next-text>
                                <feather-icon
                                    icon="ChevronRightIcon"
                                    size="18"
                                />
                            </template>
                        </b-pagination>
                    </b-col>
                </b-row>
            </div>
        </template>
    </b-card>
</template>

<script>
    import { BCard, BTable, BRow, BCol, BPagination, BDropdown, BDropdownItem } from 'bootstrap-vue'
    import FeatherIcon from '@/components/FeatherIcon'

    export default {
        name: "IndexArticle",
        components: {
            BCard,
            BTable,
            BRow,
            BCol,
            BPagination,
            BDropdown,
            BDropdownItem,

            FeatherIcon
        },
        data() {
            return {
                tableColumn: [
                    {key: 'actions', label: '', sortable: false, thStyle: {width: '33px', padding: 0}, tdClass: 'table-col-id'},
                    {key: 'id', label: 'ID', thStyle: {width: '40px'}},
                    {key: 'title', label: 'Title'},
                    {key: 'slug', label: 'Slug'},
                ],
                table: {
                    perPage: 5,
                    total: 0,
                    currentPage: 1,
                    sortBy: 'id',
                    isSortDirDesc: false,
                },
                companies: [],
                isMounted: false,
            }
        },
        watch: {
            table: {
                handler(newVal, oldVal) {
                    this.refetchData()
                },
                deep: true,
            },
        },
        mounted() {
            this.isMounted = true
        },
        computed: {
            dataMeta(){
                if(this.isMounted) {
                    const localItemsCount = this.$refs.refListTable ? this.$refs.refListTable.localItems.length : 0
                    return {
                        from: this.table.perPage * (this.table.currentPage - 1) + (localItemsCount ? 1 : 0),
                        to: this.table.perPage * (this.table.currentPage - 1) + localItemsCount,
                        of: this.table.total,
                    }
                }
                return 0
            }
        },
        methods: {
            fetchItems(ctx, callback){
                this.$store.dispatch('article/fetchArticles', {
                    perPage: this.table.perPage,
                    page: this.table.currentPage,
                    sortBy: this.table.sortBy,
                    sortDesc: this.table.isSortDirDesc,
                })
                    .then(res => {
                        const { items, total } = res.data.data
                        if(callback)
                            callback(items)
                        this.table.total = total
                    })
            },
            refetchData() {
                this.$refs.refListTable.refresh()
            },
            deleteItem(id) {
                this.$swal({
                    icon: 'info',
                    title: this.$t('ARTICLE.messages.sure_delete'),
                    showCancelButton: true,
                    textCancelButton: this.$t('BUTTONS.cancel')
                })
                    .then(res => {
                        if(res.isConfirmed){
                            this.$store.dispatch('article/destroyArticle', id)
                                .then(res => {
                                    this.$swal({
                                        title: this.$t('ARTICLE.messages.deleted'),
                                    })
                                    this.refetchData()
                                })
                        }
                    })
            },
        }
    }
</script>
