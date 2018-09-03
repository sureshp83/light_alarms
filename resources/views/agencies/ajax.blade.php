<script>

    new Vue({
        el: '#table',
        data: {
            columns: [
                { label: '', component: 'row-img', sortable: false},
                { label: '#', field: 'flight_number', sortable: false},
                { label: 'Year', field: 'launch_year', sortable: false},
                { label: 'Rocket Name', field: 'rocket.rocket_name', sortable: false},
                { label: 'Rocket Type', field: 'rocket.rocket_type', sortable: false},
                { label: 'Launch Site', field: 'launch_site.site_name', sortable: false},
                { label: 'Success', representedAs: function(row){
                    return row.launch_success ? 'Yes' : 'No';
                }, sortable: false},
            ],
            rows: window.rows,
            page: 1,
            per_page: 10,
        },
        methods: {
            getData: function(params, setRowData){
                axios.get('https://api.spacexdata.com/v2/launches').then(function(response){
                    var start_index = (params.page_number - 1) * params.page_length;
                    var end_index = start_index + params.page_length;

                    setRowData(
                        response.data.slice(start_index, end_index),
                        response.data.length
                    );
                }.bind(this));
            }
        }
    });

</script>