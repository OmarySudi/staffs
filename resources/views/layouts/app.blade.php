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

        var page_count;

        var items_per_page = 6;

        var page = 1;

        var offset = (page - 1) * items_per_page;

            function getPublication(id,name){
                        
                $.ajax({
                    type:'GET',
                    url: '/publication/'+id,
                    data:'_token = <?php echo csrf_token() ?>',
                    success: function(data){

                        $.each(data,function(key,value){

                            switch(value['name'])
                            {
                                case "Journal Article":

                                    document.getElementById('edited_journal_name').setAttribute("value",value['journal_name']);
                                    document.getElementById('journal_edited_publisher').setAttribute("value",value['publisher']);

                                    $('select[name="journal_edited_year"]').prepend('<option selected value="' + value['year'] + '">'+value['year'] + '</option>');
                                    // document.getElementById('journal_edited_year').setAttribute("value",value['year']);
                                    document.getElementById('journal_edited_link').setAttribute("value",value['link']);
                                    document.getElementById('journal_publication_id').setAttribute("value",value['id']);
                                    
                                    
                                    break;

                                case "Book":

                                    document.getElementById('book_edited_publisher').setAttribute("value",value['publisher']);
                                    document.getElementById('edited_page').setAttribute("value",value['page']);
                                    document.getElementById('edited_volume').setAttribute("value",value['volume']);
                                    document.getElementById('edited_issue').setAttribute("value",value['issue']);
                                    document.getElementById('book_edited_link').setAttribute("value",value['link']);
                                    document.getElementById('book_publication_id').setAttribute("value",value['id']);
                                    
                                    break;

                                case "Comference preceedings":

                                    document.getElementById('edited_publication_name').setAttribute("value",value['conference_publication_name']);
                                    document.getElementById('edited_city').setAttribute("value",value['city']);

                                    $('select[name="comference_year"]').prepend('<option selected value="' + value['year'] + '">'+value['year'] + '</option>');
                               
                                    document.getElementById('comference_link').setAttribute("value",value['link']);
                                    document.getElementById('comference_publication_id').setAttribute("value",value['id']);
                                   
                                    break;

                                case "Book Chapter":

                                    document.getElementById('book_edited_publisher').setAttribute("value",value['publisher']);
                                    document.getElementById('edited_page').setAttribute("value",value['page']);
                                    document.getElementById('edited_volume').setAttribute("value",value['volume']);
                                    document.getElementById('edited_issue').setAttribute("value",value['issue']);
                                    document.getElementById('book_edited_link').setAttribute("value",value['link']);
                                    document.getElementById('book_publication_id').setAttribute("value",value['id']);

                                    break;
                            }
                        })
                        
                        // document.getElementById('editedposition').setAttribute("value",data['position']);
                        // document.getElementById('editedplace').setAttribute("value",data['place']);
                        // document.getElementById('editedstartyear').setAttribute("value",data['start_year']);
                        // document.getElementById('editedendyear').setAttribute("value",data['end_year']);
                        // document.getElementById('employment_id').setAttribute("value",data['id']);
                        // document.getElementById('employment_ondelete_id').setAttribute("value",data['id']);
                    }
                });
            }

            function setPublication(id){

                $.ajax({
                    type:'GET',
                    url: '/publication/'+id,
                    data:'_token = <?php echo csrf_token() ?>',
                    success: function(data){

                        $.each(data,function(key,value){

                            document.getElementById('ondelete_publication_id').setAttribute("value",value['id']);
                        })
                    }
                });
            }

            function getProject(id){
                $.ajax({

                    type:'GET',
                    url: '/project/'+id,
                    data:'_token = <?php echo csrf_token() ?>',
                    success: function(data){

                        if(data !== null){
                            document.getElementById('edited_project_title').setAttribute("value",data['title']);
                            document.getElementById('edited_project_description').value = data['description'];
                            
                            document.getElementById('edited_project_client').setAttribute("value",data['client']);
                            document.getElementById('edited_project_link').value = data['link'];
                            
                            $('select[name="edited_project_year"]').prepend('<option selected value="' + data['year'] + '">'+data['year'] + '</option>');

                            document.getElementById('project_id').setAttribute("value",data['id']);
                            document.getElementById('project_ondelete_id').setAttribute("value",data['id']);
                        }
                    }
                });
            }

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

                function fetchPageData(offset){

                    $.ajax({

                        url: '/get-page',
                        type: "GET",
                        data: { page_offset: offset},
                        success:function(data) {

                            $('#staffs-row').html(data);
                        }
                    });

                }

                function initializeTabs(){

                    var account_type = $('#account-hidden').val();

                    if(account_type === null || account_type === ''){

                        $('a[href="#publication"').hide();
                        $('a[href="#project"').hide();
                        $('a[href="#skills"').hide();
                        $('a[href="#job"').hide();
                        $('a[href="#areas"').hide();
                    }
                    else if(account_type.localeCompare("Administrative") == 0)
                    {
                        showAdministrativeTabs();
                    }
                    else if(account_type.localeCompare("Academician") == 0)
                    {
                        showAcademicianTabs();
                    }
                }

                function fetchPublicationTypes(){

                    $.ajax({

                        url:'/publication-types',
                        type:"GET",
                        success:function(data){


                            $.each(data,function(key,value){

                                    $('select[name="publication_type"]').append('<option value="' + value['id'] + '">'+value['name'] + '</option>');
                            });
                        }
                        });
                }

                function showJounal(){

                    $('#comference-row,#city-row,#page-row,#volume-row,#issue-row').each(function(){
                            $(this).hide();
                    });

                    $('#journal-name-row,#publisher-row,#year-row,#link-row').each(function(){
                            $(this).show();
                    });

                    $('#jounal_name,#publisher,#year,#link').each(function(){
                            $(this).attr('required','required');
                    });

                    $('#issue,#volume,#page,#city,#publication_name').each(function(){
                            $(this).removeAttr('required','required');
                    });

                }

                function showBook(){

                    $('#journal-name-row,#comference-row,#city-row,#year-row').each(function(){
                            $(this).hide();
                    });

                    $('#publisher-row,#page-row,#volume-row,#issue-row,#link-row').each(function(){

                            $(this).show();
                    });

                    $('#issue,#publisher,#link,#page.#volume,').each(function(){
                            $(this).attr('required','required');
                    });

                    $('#jounal_name,#year,#city,#publication_name').each(function(){
                            $(this).removeAttr('required','required');
                    });

                }

                function showComference(){

                    $('#journal-name-row,#publisher-row,#page-row,#volume-row,#issue-row').each(function(){
                            $(this).hide();
                    });

                    $('#comference-row,#city-row,#year-row,#link-row').each(function(){
                            $(this).show();
                    });

                    $('#year,#city,#link,#publication_name').each(function(){
                            $(this).attr('required','required');
                    });

                    $('#jounal_name,#issue,#volume,page#,#publisher').each(function(){
                            $(this).removeAttr('required','required');
                    });
                    
                }

                function hideAll(){

                    $('#journal-name-row,#publisher-row,#comference-row,#city-row,#year-row,#page-row,#volume-row,#issue-row,#link-row').each(function(){
                            $(this).hide();
                    });

                    $('#link').attr('required','required');
                }

                 function showAcademicianTabs(){

                    //$('a[href="#project"').hide();
                    $('a[href="#skills"').hide();

                    $('a[href="#publication"').show()
                    $('a[href="#job"').show();
                    $('a[href="#areas"').show();
                }

                function showAdministrativeTabs(){

                    $('a[href="#publication"').hide()
                    $('a[href="#job"').hide();
                    $('a[href="#areas"').hide();

                    //$('a[href="#project"').show();
                    $('a[href="#skills"').show();
                }

                function getTotalPages(){

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
                }

                function getStaffCategories(){
                    $.ajax({

                    url:'/staff-categories',
                    type:"GET",
                    success:function(data){

                            var current_value = $('#account-hidden').val();
                        
                            $.each(data,function(key,value){

                                if(current_value.localeCompare(value['name']) == 0)
                                {
                                    console.log("it passes here 1");

                                    $('select[name="account_type"]').append('<option selected value="' + value['name'] + '">'+value['name'] + '</option>');
                                }
                                    
                                else
                                {
                                    console.log("it passes here 2");

                                    $('select[name="account_type"]').append('<option value="' + value['name'] + '">'+value['name'] + '</option>');
                                }
                                    

                            });
                        }
                    });
                }

            $(document).ready(function() {

                $(document).on('click', '.btn-add', function(e)
                {
                    e.preventDefault();

                    var controlForm = $('.controls form:first'),
                        currentEntry = $(this).parents('.entry:first'),
                        newEntry = $(currentEntry.clone()).appendTo(controlForm);

                    newEntry.find('input').val('');
                    controlForm.find('.entry:not(:last) .btn-add')
                        .removeClass('btn-add').addClass('btn-remove')
                        .removeClass('btn-success').addClass('btn-danger')
                        .html('<span class="mdi mdi-minus"></span>');
                        
                }).on('click', '.btn-remove', function(e)
                {
                    $(this).parents('.entry:first').remove();

                    e.preventDefault();
                    return false;
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

               $('#next').on('click',function(){

                    
                    page+=1;

                    if(page > 1)
                        enablePrevious();

                    if(page == page_count)
                        disableNext();

                    let offset = (page - 1) * items_per_page;

                    fetchPageData(offset);

                });

                $('#previous').on('click',function(){

                    page-=1;

                    enableNext();

                    if(page == 1)
                        disablePrevious();

                    let offset = (page - 1) * items_per_page;

                    fetchPageData(offset);

                });

                $('#account_type').on('change',function(){

                    if($(this).val().localeCompare("Academician") == 0)
                    {
                        showAcademicianTabs();
                    }
                    else if($(this).val().localeCompare("Administrative") == 0){

                        showAdministrativeTabs();
                    }
                    else
                    {
                        $('a[href="#publication"').hide();
                        $('a[href="#project"').hide();
                        $('a[href="#skills"').hide();
                        $('a[href="#job"').hide();
                        $('a[href="#areas"').hide();
                    }
                });

               getTotalPages();

               getStaffCategories();

               initializeTabs();

               fetchPublicationTypes();

               hideAll();

               setTimeout(function() {
                    $(".alert").alert('close');
                }, 2000);

               $('select[name="publication_type"]').on('change',function(){

                    var selected = $(this).find('option:selected').text()

                    switch(selected){

                        case "Journal Article":
                            
                                showJounal();

                            break;

                        case "Book":
                                showBook();
                            break;

                        case "Book Chapter":
                                showBook();
                            break;

                        case "Comference preceedings":
                                showComference();
                            break;

                        default:
                                hideAll();
                            break;
                    }
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
        <nav class="navbar header navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color:white; font-size:1.2em">
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
                                <a class="nav-link" href="{{ route('login') }}" style="color:white">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="color:white">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" style="color:white" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
