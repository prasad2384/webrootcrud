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
        <div class="container-fluid px-5 px-md-5">

            <div class="row mt-4 position-relative">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h2 class="text-warning fw-bold">Employee</h2>
                    <a href="/add_employee" class="fw-bold btn btn-warning">Add Employee</a>
                </div>
                <div class="col-6 col-md-12">
                    <table id="example" class="table table-responsive table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Age</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile No</th>
                                <th scope="col">Address</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="EmployeeTable">

                        </tbody>
                        
                    </table>
                </div>
                {{-- toast notification --}}
                <div class="toast align-items-center bg-white position-absolute top-0 start-50 translate-middle"
                    id="liveToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                    <div class="d-flex">
                        <div class="toast-body" id="toast-body">

                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
                {{-- toast notification end --}}
            </div>

        </div>
    </body>
    <script>
       
        $(function() {
            getEmployee();
        });

        function getEmployee() {
            $.ajax({
                url: '/api/fetch_employee',
                method: 'GET',
                success: function(response) {
                    EmployeeTable(response.employees);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        function EmployeeTable(employees) {
            var EmployeeTable = $('#EmployeeTable');
            var count = 1;
            EmployeeTable.empty();
            for (var i = 0; i < employees.length; i++) {
                var row = '<tr>' +
                    '<td>' + count++ + '</td>' +
                    '<td>' + employees[i].first_name + '</td>' +
                    '<td>' + employees[i].last_name + '</td>' +
                    '<td>' + employees[i].gender + '</td>' +
                    '<td>' + employees[i].age + '</td>' +
                    '<td>' + employees[i].email + '</td>' +
                    '<td>' + employees[i].mobile_number + '</td>' +
                    '<td>' + employees[i].address + '</td>' +
                    '<td><button class="btn btn-sm btn-danger mx-2 fw-bold" onclick="deleteEmployee(' + employees[i].id +
                    ')">Delete</button><button class="btn btn-sm btn-warning fw-bold" onclick="updateEmployee(' + employees[
                        i].id + ')">Update</button></td>' +
                    '</tr>';
                EmployeeTable.append(row);
            }
        }

        function deleteEmployee(id) {
            $.ajax({
                url: '/api/delete_employee/' + id,
                method: 'DELETE',
                success: function(response) {
                    var toastElement = document.getElementById('liveToast');
                    var toast = new bootstrap.Toast(toastElement);
                    $('#toast-body').text(response.message);
                    toast.show();
                    getEmployee();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function updateEmployee(id) {
            window.location.href = 'update_employee/' + id;
        }
    </script>

</html>
