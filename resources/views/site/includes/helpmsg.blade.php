{!! isset($config['value']) && !empty($config['value']) ? $config['value'] : '' !!}
@if(Auth::user() && $_user->hasRole('megaroot'))
    <a href="{{ route('admin.helpmsgs.edit', ['name'=>$config['name'], 'page'=>$page]) }}" class="root">Изменить</a>
@endif