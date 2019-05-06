{!! isset($value) && !empty($value) ? $value : '' !!}
@if(Auth::user() && $_user->hasRole('megaroot'))
    <a href="{{ route('admin.helpmsgs.edit', ['name'=>$name, 'page'=>$page]) }}" class="helpmsg_edit_link">Изменить</a>
@endif
