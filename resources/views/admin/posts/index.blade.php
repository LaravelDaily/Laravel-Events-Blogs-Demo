@extends('layouts.admin')
@section('content')
@can('post_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.posts.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.post.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.post.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Post">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.post.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.sport') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.published') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $key => $post)
                        <tr data-entry-id="{{ $post->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $post->id ?? '' }}
                            </td>
                            <td>
                                {{ $post->title ?? '' }}
                            </td>
                            <td>
                                {{ $post->sport->name ?? '' }}
                            </td>
                            <td>
                                {{ $post->event->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $post->published ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $post->published ? 'checked' : '' }}>
                            </td>
                            <td>
                                @if($post->photo)
                                    <a href="{{ $post->photo->getUrl() }}" target="_blank">
                                        <img src="{{ $post->photo->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('post_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.posts.show', $post->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('post_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.posts.edit', $post->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('post_delete')
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('post_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.posts.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Post:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection