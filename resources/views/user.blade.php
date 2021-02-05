<html>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <body>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
        <h1>
            @if (Session::has( 'success' ))
            <div class="alert alert-success">
                <p>{{ Session::get( 'success' ) }}</p>
            </div>
            @endif
            <table>
                <th>
                    User Details
                </th>
                <tr>
                    <td>User Name</td>
                    <td>Email Address</td>
                    <td>Action</td>
                </tr>
                @foreach ($data as $user)
                <tr>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->email}}</td>
                    <td>Update</td>
                    <td> <form action="{{ route('users.destroy',$user->id) }}" method="POST">

                            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit"  onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                        </form></td>
                </tr>

                @endforeach
            </table>
        </h1>
    </body>
</html>