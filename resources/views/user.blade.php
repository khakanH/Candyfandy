@extends('layouts.app')
@section('content')


               
<div class="page-wrapper">
<div class="page-content container-fluid">
               
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Users
                                    <div class="columns columns-right btn-group float-right">
                                       <a href="{{route('user-type')}}" class="btn waves-effect waves-light btn-rounded btn-info text-white"><i class="mr-2 mdi mdi-view-module"></i> User Types</a>
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-success" onclick="AddUser()"> Add User <i class="mr-2 mdi mdi-plus-circle"></i></button>

                                    </div>
                                </h4>
                                <br>


                                <div class="table-responsive">
                                    <table class="table dataTablesOptions">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="20%">Name</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody id="userTBody">
                                          
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

</div>
</div>

                                                                            

@endsection
<script type="text/javascript">
    function AddUser()
    {

        document.getElementById('user_name').value = "";
        document.getElementById('user_email').value = "";
        document.getElementById('user_id').value = "";
        $('#UserModal').modal('show');
        $('#UserModalLabel').html('Add New User');

        document.getElementById('UserModal').style.backgroundColor="rgba(0,0,0,0.8)";
        document.getElementById('UserModalDialog').style.paddingTop="0px";
        document.getElementById('UserModalData').style.padding="20px 20px 0px 20px";       

        user_type = "0"

        $.ajax({
        type: "GET",
        url: "{{ config('app.url')}}get-user-type-name-list/"+user_type,
        success: function(data) {

            $('#user_type').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Exception:' + errorThrown);
        }
    });

    }

</script>