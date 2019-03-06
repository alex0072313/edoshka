{!! isset($config['value']) && !empty($config['value']) ? $config['value'] : '' !!}
@if(Auth::user() && $_user->hasRole('megaroot'))
    <a href="{{ route('admin.helpmsgs.edit', ['name'=>$config['name'], 'page'=>$page]) }}" class="helpmsg_edit_link">Изменить</a>
@endif