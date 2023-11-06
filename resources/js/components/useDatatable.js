export default (userOptions = {}, userInitOptions = () => {
}) => ({
    loading: true,
    table: null,
    selected: [],
    config: setConfig(userOptions),
    init() {
        this.config.pageLength = this.config.lengthMenu[0].value;
        this.render();
        ['url', 'search', 'orderBy.column', 'orderBy.dir', 'pageLength', 'page'].forEach((key, index) => {
            this.$watch(`config.${key}`, (val, old) => {
                if (val !== old) {
                    this.config = {
                        ...this.config,
                        query: {}
                    }
                    if (key !== 'page')
                        this.config.page = 1;
                    this.loading = true;
                }
            })
        })
        this.$watch('loading', (val) => {
            if (val === true)
                this.render();
        })
        Alpine.effect(
            () => Alpine.store("breakpoints").name && (this.loading = true)
        );
        userInitOptions()
    },
    render() {
        const queryString = {
            ...Object.fromEntries(
                new URLSearchParams(window.location.search)
            ),
            page: this.config.page,
            orderBy: JSON.stringify(this.config.orderBy),
            pageLength: this.config.pageLength,
            search: this.config.search,
            filters: JSON.stringify(this.config.filters),
        };

        fetch(`${this.config.url}?${new URLSearchParams(queryString).toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        }).then(response => response.json()).then(response => {
            this.config = {
                ...this.config,
                page: response.page,
                columns: response.columns,
                query: response.query
            }
        }).then(() => {
            this.loading = false;
        })
    },
    handleRefresh(event) {
        this.config = {
            ...this.config,
            query: {}
        }
        this.loading = event.detail;
    },
    paginate(url) {
        if (url != null) {
            const page = parseInt((new URL(url)).searchParams.get('page'));
            if (page !== this.config.page)
                this.config.page = page;
        }
    },
    sort(column) {
        this.config.orderBy = {
            column: column.name,
            dir: this.config.orderBy.dir === 'ASC' ? 'DESC' : 'ASC'
        }
    },
    // onRowSelect(id) {
    //     if (this.$event.target.checked)
    //         this.selected.push(id)
    //     else
    //         this.selected = this.selected.filter(function (rowId) {
    //             return id !== rowId
    //         })
    // },
    selectAll() {
        if (this.$event.target.checked)
            this.selected = this.config.query.data.map(row => row.id)
        else
            this.selected = [];
    },
    selectAllEffect($el) {
        if (this.selected.length) {
            if (this.selected.length < this.config.query.data.length) {
                $el.indeterminate = true;
                $el.checked = false;
            } else if (this.selected.length === this.config.query.data.length) {
                $el.checked = true;
                $el.indeterminate = false;
            }
        } else {
            $el.checked = false;
            $el.indeterminate = false;
        }
    },
});

const setConfig = (options) => {
    return {
        url: '',
        page: 1,
        pageLength: options.pageLength ?? null,
        lengthMenu: options.lengthMenu ?? [
            {value: 10, text: 10},
            {value: 20, text: 20},
            {value: 50, text: 50},
            {value: 100, text: 100},
            {value: -1, text: 'All'}
        ],
        orderBy: options.orderBy ?? {
            column: null,
            dir: '',
        },
        search: options.search ?? '',
        filters: options.filters ?? {},
        columns: [],
        query: {},
    };
};
