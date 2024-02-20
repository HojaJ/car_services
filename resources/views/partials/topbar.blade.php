<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>

            
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                 aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                               placeholder="Search for..." aria-label="Search" 
                               aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->first_name }}&nbsp;{{ auth()->user()->last_name }}</span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Log Out') }}
                </a>
            </div>
        </li>

    </ul>

</nav>

@push('scripts')
@if(auth()->user()->role = "admin")
    <script>
    function sendMarkRequest(id = null) {
        return $.ajax("", {
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function(e) {
            event.preventDefault();
            let href = this.href;
            let request = sendMarkRequest($(this).data('id'));
            window.location = href;
        });

            var search_ul = $('.search-result');
            $(document).on('keyup', '#search', function(){
                
                var query = $(this).val();
                if( query == "" || query.length < 3){
                    search_ul.css('display', 'none');
                }else {
                    search_ul.css('display', 'block');
                    fetch_customer_data(query);                    
                }
            });
            function fetch_customer_data(query = '')
            {
                $.ajax({
                    url:"",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data) {
                        search_ul.html(data.data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        
        // $('#mark-all').click(function() {
        //     let request = sendMarkRequest();
        //     request.done(() => {
        //         $('div.alert').remove();
        //     })
        // });
    });
    </script>
@endif
@endpush