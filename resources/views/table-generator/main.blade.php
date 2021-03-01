<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> Bugloos </title>
    <link href="/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>
<!--**** Preloader start ****-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--**** Preloader end ****-->

<div id="main-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{ $data['heading'] }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper no-footer">

                                <form action="{{ request()->url() }}" method="get">
                                    @include('table-generator.partials.number-of-rows')
                                    @include('table-generator.partials.sorting', ['columns' => $data['sortableColumns']])
                                    @include('table-generator.partials.searching')
                                </form>

                                <div id="table-data">
                                    <table class="display dataTable no-footer" style="min-width: 845px" role="grid">
                                        @include('table-generator.partials.thead', ['columns' => $data['columns']])
                                        @include('table-generator.partials.tbody', [
                                                    'columns' => $data['columns'],
                                                    'collection' => $data['paginator']->getCollection()])
                                    </table>
                                    @include('table-generator.partials.info', ['paginator' => $data['paginator']])

                                    {{ $data['paginator']->links('table-generator.partials.pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--**** Scripts ****-->
<script src="/js/global.min.js"></script>
<script src="/js/bootstrap-select.min.js"></script>
<script src="/js/custom.min.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){

        $(document).on('click', '.dataTables_paginate a', function(event){
            let page = $(this).attr('href').split('page=')[1];
            requestToServer(event, page);
        });

        $(document).on('change', '.queryChanged', function(event) {
            let page = 1;
            requestToServer(event, page);
        })

        $(document).on('keyup', '#search', function(event) {
            let page = 1;
            requestToServer(event, page);
        });

        function requestToServer(event, page) {
            event.preventDefault();
            let sortBy = $('#sortBy').val();
            let rowPerPage = $('#rowPerPage').val();
            let sortDirection = $('#sortDirection').val();
            let searchTerm = $('#searchTerm').val();

            $.ajax({
                url: "{{ request()->url() }}" + makeQueryString(
                                                    page,
                                                    sortBy,
                                                    rowPerPage,
                                                    sortDirection,
                                                    searchTerm
                                                ),

                success: function(data) {
                    $('#table-data').html(data);
                    scrollUp();
                    changeUrl(page,sortBy,rowPerPage,sortDirection,searchTerm);
                }
            });
        }

        function scrollUp() {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        }

        function changeUrl(page, sortBy, rowPerPage, sortDirection, searchTerm) {
            history.replaceState(null, null,
                makeQueryString(
                    page,
                    sortBy,
                    rowPerPage,
                    sortDirection,
                    searchTerm
                ),
            )
        }

        function makeQueryString(page, sortBy, rowPerPage, sortDirection, searchTerm) {
            return  "?page=" + page
                + "&sortBy=" + sortBy
                + "&rowPerPage=" + rowPerPage
                + "&sortDirection=" + sortDirection
                + "&searchTerm=" + searchTerm;
        }

    });
</script>

</body>
</html>
