<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>

    </head>

    <body class="bg-black">
        <div class="container-fluid px-5 ">
            <div class="row p-5 mt-4 rounded shadow-lg bg-body-light position-relative">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-center text-warning mb-2 fw-bold">Update Employee</h3>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                        <label for="first-name" class="text-white">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name"
                            placeholder="First Name" value="{{ $data->first_name }}">
                        <div><span id="error_first_name" class="text-danger fw-bold"></span></div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                        <label for="last-name" class="text-white">Last Name</label>
                        <input type="text" class="form-control" value="{{ $data->last_name }}" name="last_name"
                            id="last_name" placeholder="Last Name">
                        <div><span id="error_last_name" class="text-danger fw-bold"></span></div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                        <label for="gender" class="text-white">Gender</label>
                        <select class="form-select" name="gender" id="gender">
                            <option value="">-------Select Gender-------</option>
                            <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Others" {{ $data->gender == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                        <div><span id="error_gender" class="text-danger fw-bold"></span></div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                        <label for="age" class="text-white">Age</label>
                        <input type="number" class="form-control" name="age" id="age"
                            value="{{ $data->age }}">
                        <div><span id="error_age" class="text-danger fw-bold"></span></div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                        <label for="email" class="text-white">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Enter Email" value="{{ $data->email }}">
                        <div><span id="error_email" class="text-danger fw-bold"></span></div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                        <label for="mobile-number" class="text-white">Mobile Number</label>
                        <input type="number" class="form-control" name="mobile_number" id="mobile_number"
                            placeholder="Enter Mobile Number" value="{{ $data->mobile_number }}">
                        <div><span id="error_mobile_number" class="text-danger fw-bold"></span></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-2">
                        <label for="address" class="text-white">Address</label>
                        <textarea name="address" class="form-control" name="address" id="address" cols="30" rows="3">{{ $data->address }}</textarea>
                        <div><span id="error_address" class="text-danger fw-bold"></span></div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-warning px-3 fw-bold float-end"
                        onclick="UpdateEmployee({{ $data->id }})">Update</button>
                </div>
                {{-- toast notification --}}
                <div class="toast align-items-center bg-white position-absolute top-0 start-50 translate-middle"
                    id="liveToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                    <div class="d-flex">
                        <div class="toast-body">
                            Employee Update Successfully...
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
                {{-- toast notification end --}}
            </div>

        </div>

        <script>
            function UpdateEmployee(id) {
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var gender = $('#gender').val();
                var age = $('#age').val();
                var email = $('#email').val();
                var mobile_number = $('#mobile_number').val();
                var address = $('#address').val();
                $('#error_first_name').text('');
                $('#error_last_name').text('');
                $('#error_gender').text('');
                $('#error_age').text('');
                $('#error_email').text('');
                $('#error_mobile_number').text('');
                $('#error_address').text('');
                $.ajax({
                    url: '/api/update_employee/' + id,
                    method: 'PUT',
                    data: {
                        first_name: first_name,
                        last_name: last_name,
                        gender: gender,
                        age: age,
                        email: email,
                        mobile_number: mobile_number,
                        address: address
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.errors) {

                            if (response.errors && response.errors.first_name && response.errors.first_name[0]) {
                                $('#error_first_name').text(response.errors.first_name[0]);
                            }
                            if (response.errors && response.errors.last_name && response.errors.last_name[0]) {
                                $('#error_last_name').text(response.errors.last_name[0]);
                            }
                            if (response.errors && response.errors.gender && response.errors.gender[0]) {
                                $('#error_gender').text(response.errors.gender[0]);
                            }
                            if (response.errors && response.errors.age && response.errors.age[0]) {
                                $('#error_age').text(response.errors.age[0]);
                            }
                            if (response.errors && response.errors.email && response.errors.email[0]) {
                                $('#error_email').text(response.errors.email[0]);
                            }
                            if (response.errors && response.errors.mobile_number && response.errors.mobile_number[
                                    0]) {
                                $('#error_mobile_number').text(response.errors.mobile_number[0]);
                            }
                            if (response.errors && response.errors.address && response.errors.address[0]) {
                                $('#error_address').text(response.errors.address[0]);
                            }
                        } else {
                            first_name = $('#first_name').val('');
                            last_name = $('#last_name').val('');
                            gender = $('#gender').val('');
                            age = $('#age').val('');
                            email = $('#email').val('');
                            mobile_number = $('#mobile_number').val('');
                            address = $('#address').val('');
                            var toastElement = document.getElementById('liveToast');
                            var toast = new bootstrap.Toast(toastElement);
                            toast.show();
                            setTimeout(() => {
                                window.location.href = '/'
                            }, 5000);
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            }
        </script>
    </body>

</html>
