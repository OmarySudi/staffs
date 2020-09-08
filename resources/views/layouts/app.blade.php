<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Staffs') }}</title>

    <!-- Jquery -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>

    <!--Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css">
    <!---fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/project.css') }}" rel="stylesheet">

    <script>

        

        $(document).ready(function() {

            var page_count;

            var items_per_page = 4;

            var page = 1;

            var offset = (page - 1) * items_per_page;

            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
           
            function disableAll(){
                $('#previous').addClass('disable-link');
                $('#previous').removeClass('enable-link');

                $('#next').addClass('disable-link');
                $('#next').removeClass('enable-link');
            }

            function disablePrevious(){

                $('#previous').addClass('disable-link');
                $('#previous').removeClass('enable-link');
            }

            function disableNext(){

                $('#next').addClass('disable-link');
                $('#next').removeClass('enable-link');
            }

            function enablePrevious(){

                $('#previous').addClass('enable-link');
                $('#previous').removeClass('disable-link');
            }

            function enableNext(){

                $('#next').addClass('enable-link');
                $('#next').removeClass('disable-link');
            }

            function checkpage(){

            }

            function fetchNext(){

            }

            function fetchPrevious(){

            }

            $('#next').on('click',function(){

                page+=1;

                if(page > 1)
                    enablePrevious();
                
                if(page == page_count)
                    disableNext();

            });

            $('#previous').on('click',function(){

                page-=1;

                enableNext();

                if(page == 1)
                    disablePrevious();
                
            });

            $('#search').on('keyup',function(){

                $value=$(this).val();
                $.ajax({
                    type : 'GET',
                    url : '/staffs/search/department',
                    data:{'search':$value},
                    success:function(data){
                        $('#staffs-row').html(data);
                    }
                });
            });

            $('select[name="role[]"]').on('change',function(){

                // if($('#role option:selected').text() == 'Lecturer')
                //     $('#currentCourse').show();
                // else 
                //     $('#currentCourse').hide();
            });

            $('select[name="department"]').on('change',function(){

                var departmentId = $(this).val();

                if(departmentId){
                    $.ajax({

                        url: '/courses/get-courses/'+departmentId,

                        type: "GET",

                        dataType: "json",

                        success:function(data) {


                            $('select[name="courses[]"]').empty();

                            $.each(data, function(key, value) {

                                $('select[name="courses[]"]').append('<option value="'+ value['id'] +'">'+ value['name'] +'</option>');

                            });


                        }

                    });
                }else {

                    $('select[name="courses"]').empty();
                }
                
            });


            $.ajax({

                url: '/get-total-pages',

                type: "GET",

                dataType: "json",

                success:function(data) {

                    page_count = data;

                    if(data == 0 || data == 1){

                        disableAll();
                    }

                    if(page == 1)
                        disablePrevious();
                    else if(page == data)
                        disableNext();
                }

            });

        });


    function getEducationHistory(id){
        
        $.ajax({
            type:'GET',
            url: '/education/'+id,
            data:'_token = <?php echo csrf_token() ?>',
            success: function(data){

                document.getElementById('editedcollege').setAttribute("value",data['university']);
                document.getElementById('editedfaculty').setAttribute("value",data['course']);
                document.getElementById('editedyear').setAttribute("value",data['year']);
                document.getElementById('education_id').setAttribute("value",data['id']);
                document.getElementById('ondelete_id').setAttribute("value",data['id']);
            }
        });
    }

    function getEmploymentHistory(id){

        $.ajax({
            type:'GET',
            url: '/employment/'+id,
            data:'_token = <?php echo csrf_token() ?>',
            success: function(data){

                console.log(data);
                document.getElementById('editedposition').setAttribute("value",data['position']);
                document.getElementById('editedplace').setAttribute("value",data['place']);
                document.getElementById('editedstartyear').setAttribute("value",data['start_year']);
                document.getElementById('editedendyear').setAttribute("value",data['end_year']);
                document.getElementById('employment_id').setAttribute("value",data['id']);
                document.getElementById('employment_ondelete_id').setAttribute("value",data['id']);
            }
        });
    }

    </script>

   

</head>
<body>

   

    </script>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Staffs') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</script>
</body>
</html>
