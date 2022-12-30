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
    <form method="POST" action="/userhandle">
      @csrf
    <tr class="admin-panel-row">
         <td class="admin-panel-cell"><input type="text" class="userId" id="userId" name="userId" readonly value = "{{ $user['id_user'] }}"/></td>
         <td class="admin-panel-cell">{{ $user['login'] }}</td>
         <td class="admin-panel-cell">{{ $user['email'] }}</td>
         <td class="admin-panel-cell">
                    {{DB::table('roles')
                    ->select('name')
                    ->whereIn('id', (DB::table('users')->join('model_has_roles','users.id_user','=','model_has_roles.model_id')
                    ->select('model_has_roles.role_id')
                    ->where('model_has_roles.model_id',$user['id_user'])
                    ->get()->pluck('role_id')))->get()->pluck('name')
                    
                     }}
             </td>
             
                @csrf
                <td class="admin-panel-cell">
                <button type="submit" name="function" class="remove" value="DELETE"><i class="fa-solid fa-trash"></i></button>
             </td>
             <td class="admin-panel-cell">
                <select name="role" class="classic" id="role">
                @foreach ($allRoles  as $role )
               
               <option>{{ $role }}</option> 
               
               @endforeach
            </select>
             </td>
             <td class="admin-panel-cell">
                <button type="submit" name="function" class="add" value="ADD"><i class="fa-solid fa-user-plus"></i></button>
             </td>
             <td class="admin-panel-cell">
                <button type="submit" name="function" class="remove" value="REMOVE"><i class="fa-solid fa-user-minus"></i></button>
             </td>
            </tr>
        
         </form>
    @endforeach
   </table>

   </div>
</x-layout>