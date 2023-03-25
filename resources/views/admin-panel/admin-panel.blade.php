<x-layout>
    <div class="all-users">

        <table class="admin-panel">
            <tr class="admin-panel-row first-row">
                <td class="admin-panel-cell">Id Użytkownika</td>
                <td class="admin-panel-cell">Login</td>
                <td class="admin-panel-cell">Email</td>
                <td class="admin-panel-cell">Role</td>
                <td class="admin-panel-cell">Usuń konto</td>
                <td class="admin-panel-cell">Rola</td>
                <td class="admin-panel-cell">Dodaj Rolę</td>
                <td class="admin-panel-cell"> Usuń Rolę</td>
            </tr>
            @foreach ($allUsers as $user)
                <form class="admin-form" method="POST" action="/userhandle">
                    @csrf
                    <tr class="admin-panel-row" id=row{{ $user['id_user'] }}>
                        <td class="admin-panel-cell"><input type="text" class="userId" id="userId" name="userId"
                                readonly value="{{ $user['id_user'] }}" /></td>
                        <td class="admin-panel-cell">{{ $user['login'] }}</td>
                        <td class="admin-panel-cell">{{ $user['email'] }}</td>
                        <td class="admin-panel-cell" id=user{{ $user['id_user'] }}>
                            @foreach (DB::table('roles')->select('name')->whereIn(
            'id',
            DB::table('users')->join('model_has_roles', 'users.id_user', '=', 'model_has_roles.model_id')->select('model_has_roles.role_id')->where('model_has_roles.model_id', $user['id_user'])->get()->pluck('role_id'),
        )->get() as $role)
                                {{ $role->name }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>

                        @csrf
                        <td class="admin-panel-cell">
                            <button type="submit" name="function" class="remove" value="DELETE"><i
                                    class="fa-solid fa-trash"></i></button>
                        </td>
                        <td class="admin-panel-cell">
                            <select name="role" class="classic" id="role">
                                @foreach ($allRoles as $role)
                                    <option>{{ $role }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="admin-panel-cell">
                            <button type="submit" name="function" class="add" value="ADD"><i
                                    class="fa-solid fa-user-plus"></i></button>
                        </td>
                        <td class="admin-panel-cell">
                            <button type="submit" name="function" class="remove" value="REMOVE"><i
                                    class="fa-solid fa-user-minus"></i></button>
                        </td>
                    </tr>

                </form>
            @endforeach
        </table>

    </div>
    <script>
        var func_val = 0;
        $('button').click(function() {
            func_val = $(this).attr('value')
        })
        $(".admin-form").on('submit', function(event) {
            event.preventDefault();
            event.preventDefault();
            var inputs = $(this).serializeArray();

            var url = $(this).attr('action')

            var data = {
                'function': func_val,
                'userId': inputs[1].value,
                'role': inputs[3].value
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: url,
                data: data,
                dataType: "json",
                success: function(response) {

                    if (response.status == 400) {
                        console.log('ERROR');
                    } else if (response.status == 201) {
                        $('.error-content').text(response.message)
                        $('.flash-error').slideDown(300);
                        $('.flash-error').delay(3000).slideUp(300);
                        console.log('bad')
                    } else {
                        console.log('good')
                        $('.success-content').text(response.message)
                        $('.flash-success').slideDown(300);
                        $('.flash-success').delay(3000).slideUp(300);
                        if (func_val == 'DELETE') {
                            $('#row' + response.id_user).slideUp(300)
                        }
                        var str = '';
                        (response.roles).forEach(element => {
                            if ((response.roles)[(response.roles).length - 1] === element) {
                                str += element.name;
                            } else {
                                str += element.name + ' , ';
                            }

                        });
                        $('#user' + response.id_user).text(str);
                    }
                }
            });
        })
    </script>
</x-layout>
