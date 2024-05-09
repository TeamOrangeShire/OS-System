@if (session()->has('Admin_id'))
    <!DOCTYPE html>
    <html lang="en">

    <head>
        @include('admin.assets.header', ['title' => 'Blogs'])

        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet" />
    </head>

    <body class="">
        <div class="lds-roller" id="roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->
        <!-- [ navigation menu ] start -->
        @include('admin.component.nav')
        <!-- [ navigation menu ] end -->
        <!-- [ Header ] start -->
        @include('admin.component.header')
        <!-- [ Header ] end -->



        <!-- [ Main Content ] start -->
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ Main Content start ] start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Basic Alerts</h5>
                            <button class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#out'>Button</button>
                        </div>
                        <div class="card-body">

                            <div class="row" id="blogCard">

                               

                            </div>

                        </div>
                    </div>
                </div>

                {{-- modal start info --}}
                <div id="out" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Blog Content</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="addnewblog" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="">Blog Title</label>
                                            <input type="text" id="title" name="title" class="form-control">
                                            <input type="hidden" name="content" id="content">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Category</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="Entertainment">Entertainment</option>
                                                <option value="Informative">Informative</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Blog Content</label>
                                            <div id="editor" style="height: auto;"></div>
                                        </div>

                                    </div>
                                    <button type="button" class="btn btn-primary mt-3"
                                        onclick="insertContent()">Display Content</button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}
                <!-- [ Main Content ] end -->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>
        <script>
            const quill = new Quill('#editor', {
                theme: 'snow',
                formats: [
                    'header', 'bold', 'italic', 'underline', 'strike', 'blockquote',
                    'list', 'bullet', 'indent', 'link', 'image'
                ],
                modules: {
                    toolbar: [
                        [{
                            'header': [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'indent': '-1'
                        }, {
                            'indent': '+1'
                        }],

                        ['clean']
                    ]
                }
            });

            function insertContent() {
                const title = document.getElementById('title').value;
                var content = document.getElementById("content").value = quill.root.innerHTML;
                console.log(title);
                console.log(content);

                var formData = $("form#addnewblog").serialize();

                console.log(formData);
                $.ajax({
                    type: "POST",
                    url: "{{ route('AddBlog') }}",
                    data: formData,
                    success: function(response) {
                        console.log(response.data);
                      $('#blogCard').load(location.href + ' #blogCard');
                    },
                    error: function(xhr, status, error) {

                        console.error(xhr.responseText);
                    }
                });
            }
            $(document).ready(function() {
                GetBlog();
            });

         function GetBlog() {
    $.ajax({
        type: "GET",
        url: "{{ route('GetBlog') }}",
        success: function(response) {
              $('#blogCard').empty();
            response.data.forEach(function(blogEntry) {
                 var cardDiv = $('<div class="col-md-3 mb-3" style="margin:1%">' +
                                    '<div class="card" style="">' +
                                        '<img class="card-img-top" src="' + blogEntry.image_url + '" alt="Card image cap">' +
                                        '<div class="card-body">' +
                                            '<h5 class="card-title">' + blogEntry.blog_title + '</h5>' +
                                            '<p class="card-text">' + blogEntry.blog_content + '</p>' +
                                            '<a href="#" class="btn btn-primary">Go somewhere</a>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>');
                $('#blogCard').append(cardDiv);
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

        </script>
        <!-- [ Main Content ] end -->
        <!-- Required Js -->
        @include('admin.assets.adminscript')


    </body>

    </html>
@else
    @php
        echo '<script>
            window.location.href = "login";
        </script>';
    @endphp
@endif
