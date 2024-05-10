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
                            <h5>Blogs</h5>
                            <div>
                                <button class="btn btn-primary" data-bs-toggle='modal'
                                    data-bs-target='#makeCategory'>Create New Category</button>
                                <button class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#out'>Create New
                                    Blog</button>
                            </div>
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
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
                                                @php
                                                    $category = App\Models\BlogCategory::all();
                                                @endphp
                                                @foreach ($category as $cat )
                                                    <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="">Blog Cover</label>
                                            <input type="file" id="image" name="image" class="form-control">
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
                {{-- modal start info --}}
                <div id="viewBlog" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
                                            <input type="text" id="title2" name="title" class="form-control">
                                            <input type="hidden" name="blog_id" id="blog_id">
                                            <input type="hidden" name="content" id="content2">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Category</label>
                                            <select name="category" id="category2" class="form-control">
                                                  @foreach ($category as $cat )
                                                    <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="">Blog Cover</label><br>
                                            <img class="" width="50%" height="auto" alt="Card"
                                                id="blog_image"><br>
                                            <button type="button" class="btn btn-primary mt-3"
                                                data-bs-toggle="modal" data-bs-target="#UpdateCoverBlog"
                                                onclick="UpdateCover(document.getElementById('blog_id').value)">Update
                                                Cover</button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Blog Content</label>
                                            <div id="editor2" style="height: auto;"></div>
                                        </div>

                                    </div>
                                    <button type="button" class="btn btn-primary mt-3"
                                        onclick="EditContent()">Display Content</button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}
                {{-- modal start info --}}
                <div id="UpdateCoverBlog" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Update Blog Cover</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="updateblogcober" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Blog Cover</label>
                                            <input type="hidden" name="cover_id" id="cover_id">
                                            <input type="file" id="coverpic" name="coverpic"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary mt-3"
                                        onclick="UpdateBlogCover()">Display Content</button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}
                {{-- modal start info --}}
                <div id="makeCategory" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Add New Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="formCategory" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Blog Category</label>
                                            <input type="text" class="form-control" name="newcatogory"
                                                id="newcatogory">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary mt-3"
                                        onclick="AddNewCategory()">Add</button>

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
                    'list', 'indent', 'link', 'align'
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
                        }],
                        [{
                            'indent': '-1'
                        }, {
                            'indent': '+1'
                        }],
                        [{
                            'align': []
                        }],
                        ['clean']
                    ]
                }
            });


            function insertContent() {
                const title = document.getElementById('title').value;
                const category = document.getElementById('category').value;
                var content = quill.root.innerHTML;
                const pic = document.getElementById('image');
                if (pic.files.length == 0) {
                    alertify
                        .alert("Warning", "Blog Cover Require", function() {
                            alertify.message('OK');
                        });
                } else {
                    var formData = new FormData();
                    formData.append('title', title);
                    formData.append('content', content);
                    formData.append('category', category);
                    formData.append('image', $('#image')[0].files[0]);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('AddBlog') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response == "exceed") {
                                alertify
                                    .alert("Warning", "Image Too Large", function() {
                                        alertify.message('OK');
                                    });
                            } else if (response == "invalid_type") {
                                alertify
                                    .alert("Warning", "Invalid Image Format", function() {
                                        alertify.message('OK');
                                    });
                            }else{
                                    alertify
                                .alert("Message", "Blog Successfully Posted", function() {
                                    alertify.message('OK');
                                    $('#blogCard').empty();
                                    GetBlog();
                                    $('#out').modal('hide');
                                });
                            }
                        
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

            }

            $(document).ready(function() {
                GetBlog();
            });

            function GetBlog() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('GetBlog') }}",
                    success: function(response) {

                        response.data.forEach(function(blogEntry) {
                            $('#coverphoto').attr('src', $('#coverphoto').attr('src'));
                            const image = "{{ asset('User/Admin/') }}/" + blogEntry.blog_picture;
                            const contentLimit = blogEntry.blog_content.length <= 100 ? blogEntry
                                .blog_content : blogEntry.blog_content.substring(0, 100) +
                                '.....';
                            var cardDiv = $(
                                '<div class="col-md-4 mb-3">' +
                                '<div class="card">' +
                                '<img class="card-img-top" id="coverphoto" src="' + image +
                                '" alt="Card">' +
                                '<div class="card-body">' +
                                '<h5 class="card-title">' + blogEntry.blog_title + '</h5>' +
                                '<p class="card-text">' + contentLimit + '</p>' +
                                '<div class="d-flex justify-content-between">' +
                                '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewBlog" onclick="viewBlog(' +
                                blogEntry.blog_id + ')">Edit</button>' +
                                '<button class="btn btn-danger" onclick="DeleteBlog(' + blogEntry
                                .blog_id + ')">Delete</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                            );
                            $('#blogCard').append(cardDiv);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            let quill2;

            function viewBlog(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('GetBlogEdit') }}?blog_id=" + id,
                    success: function(response) {

                        var responseData = response.data;
                        responseData.forEach(function(blog) {
                            document.getElementById('blog_id').value = blog.blog_id;
                            document.getElementById('title2').value = blog.blog_title;
                            document.getElementById('category2').value = blog.blog_category;
                            document.getElementById('blog_image').src = '{{ asset('User/Admin/') }}/' + blog
                                .blog_picture;
                            quill2 = refreshQuill(quill2);
                            quill2.root.innerHTML = '';
                            quill2.root.innerHTML = blog.blog_content;
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });


                function refreshQuill(quillInstance) {

                    if (quillInstance instanceof Quill) {
                        quillInstance.root.innerHTML = '';
                        quillInstance.setContents([{
                            insert: '\n'
                        }]);
                        return quillInstance;
                    }

                    // Reinitialize Quill
                    quillInstance = new Quill('#editor2', {
                        theme: 'snow',
                        formats: [
                            'header', 'bold', 'italic', 'underline', 'strike', 'blockquote',
                            'list', 'indent', 'link', 'align'
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
                                }],
                                [{
                                    'indent': '-1'
                                }, {
                                    'indent': '+1'
                                }],
                                [{
                                    'align': []
                                }], 
                                ['clean']
                            ]
                        }
                    });
                    return quillInstance;
                }
                quill2 = refreshQuill(quill2);
            }

            function EditContent() {
                const blog_id = document.getElementById('blog_id').value;
                const title = document.getElementById('title2').value;
                const category = document.getElementById('category2').value;
                const content = quill2.root.innerHTML.toString();

                var formData = new FormData();
                formData.append('blog_id', blog_id);
                formData.append('title', title);
                formData.append('content', content);
                formData.append('category', category);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: "{{ route('EditBlog') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        
                        alertify
                            .alert("Message", "Blog Successfully Edited", function() {
                                alertify.message('OK');
                                $('#blogCard').empty();
                                GetBlog();
                                $('#viewBlog').modal('hide');
                            });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function DeleteBlog(id) {
                const blog_id = id;
                var formData = new FormData();
                formData.append('blog_id', blog_id);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: "{{ route('DeleteBlog') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alertify
                            .alert("Message", "Blog Successfully Deleted", function() {
                                alertify.message('OK');
                                $('#blogCard').empty();
                                GetBlog();

                            });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function UpdateCover(id) {
                const blog_id = document.getElementById('cover_id').value = id;
            }

            function UpdateBlogCover() {
                const blog_id = document.getElementById('cover_id').value;
                const pic = document.getElementById('coverpic');
                if (pic.files.length == 0) {
                    alertify
                        .alert("Warning", "Blog Cover Require", function() {
                            alertify.message('OK');
                        });
                } else {
                    var formData = new FormData();
                    formData.append('blog_id', blog_id);
                    formData.append('coverpic', $('#coverpic')[0].files[0]);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('UpdateBlogCover') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                                if (response.status == "exceed") {
                                alertify
                                    .alert("Warning", "Image Too Large", function() {
                                        alertify.message('OK');
                                    });
                            } else if (response.status == "invalid_type") {
                                alertify
                                    .alert("Warning", "Invalid Image Format", function() {
                                        alertify.message('OK');
                                    });
                            }else{
                            $('#blogCard').empty();
                            GetBlog();
                            $('#UpdateCoverBlog').modal('hide');
                            $('#coverphoto').attr('src', $('#coverphoto').attr('src'));
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            }

            function AddNewCategory() {
                var formData = $("form#formCategory").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ route('AddNewCategory') }}",
                    data: formData,
                    success: function(response) {
                        if (response == 'exist') {
                            alertify
                                .alert("Message", "Category Already Exist", function() {
                                    alertify.message('OK');
                                    $('#blogCard').empty();
                                    GetBlog();
                                });
                        } else {
                            alertify
                                .alert("Message", "Successfully Added New Category ", function() {
                                    alertify.message('OK');
                                    $('#blogCard').empty();
                                    GetBlog();
                                    $('#makeCategory').modal('hide');
                                });
                        }

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
