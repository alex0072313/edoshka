@extends('layouts.admin')

@section('content')

    <a href="{{ route('admin.specials.create') }}" class="btn btn-primary btn-lg mb-4">Добавить акцию</a>

    @if(count($specials))
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th width="1%" class="pr-0">ID</th>
                    <th width="1%" class="pr-0"></th>
                    <th>Название</th>
                    <th>Использует ресторанов</th>
                    <th>Статус</th>
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody id="sort_items">
                @foreach($specials as $special)
                    <tr data-id="{{$special->id}}">
                        <td class="pr-0">
                            {{ $special->id }}
                        </td>
                        <td width="1%" class="with-img">
                            @if(isset($special->id) && Storage::disk('public')->exists('special_imgs/'.$special->id.'/img_xs.jpg'))
                                <img src="{{ Storage::disk('public')->url('special_imgs/'.$special->id.'/img_xs.jpg') }}" class="img-rounded rounded-circle" />
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.specials.edit', $special->id) }}">{{ $special->name }}</a>
                        </td>
                        <td>
                            {{ $special->restaurants()->count() }}
                        </td>
                        <td>{{ $special->status ? 'Да' : 'Нет' }}</td>
                        <td class="with-btn text-center" nowrap>
                            <a href="{{ route('admin.specials.edit', $special->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                            @hasrole('megaroot')
                                <a href="{{ route('admin.specials.destroy', $special->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить акцию {{ $special->name }}{{ $special->restaurants()->count() ? '(привязана к '.$special->restaurants()->count().' ресторану(нам))':'' }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                            @endrole
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    @else
        <p class="lead">
            Нет добавленных акций
        </p>
    @endif

@endsection

@push('js')
    {{--<script src="/assets/js/sortablejs/Sortable.min.js"></script>--}}
    {{--<script>--}}
        {{--var el = document.getElementById('sort_items');--}}
        {{--var sortable = Sortable.create(el, {--}}
            {{--ghostClass: 'sortghost',--}}
            {{--onUpdate: function () {--}}
                {{--var ids = [];--}}
                {{--$('#sort_items > tr').each(function () {--}}
                    {{--ids.push(parseInt($(this).data('id')));--}}
                {{--});--}}

                {{--$.ajax({--}}
                    {{--url: '{{ route('admin.specials.sort') }}',--}}
                    {{--dataType: 'json',--}}
                    {{--data: {ids:ids},--}}
                    {{--type: 'post',--}}
                    {{--success:function(response){--}}
                        {{--console.log(response);--}}
                    {{--},--}}
                {{--});--}}

            {{--}--}}
        {{--});--}}
    {{--</script>--}}
@endpush
