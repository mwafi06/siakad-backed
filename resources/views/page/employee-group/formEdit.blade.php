<div class="card card-primary card-outline employee-group">
    <div class="card-header">
        <h3 class="card-title">{{ ucfirst($page) ?? 'Page Title' }}</h3>
        <div class="row table-action justify-content-end">
            <div class="col-2 no-padding text-right">
                <a class="btn btn-success btn-sm text-light form-action-save" data-target="#form-data"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Save</a>
                <a class="btn btn-danger btn-sm text-light form-action-cancel" data-href="{{ url(route('employee-group')) }}"><i class="fas fa-times"></i>&nbsp;&nbsp;&nbsp;Cancel</a>
            </div>
        </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
        <form class="form-horizontal row" method="POST" action="{{ url(route('employee-group.update')) }}" id="form-data">
            @csrf
            <div class="col-6">
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                @foreach($module as $value)
                    <div class="module-list parent">
                        <div><i class="{{$value->mod_icon}}"></i> {{$value->mod_name}}</div>
                    </div>
                    @if(count((array)$value->detail)>0)
                        @foreach($value->detail as $child)
                            <div class="module-list">
                                <div>{{$child->mod_name}}</div>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input name="delete[]" type="checkbox" value="{{$child->modid}}" id="delete-{{$child->modid}}" class="form-check-input">
                                        <label class="form-check-label" for="delete-{{$child->modid}}">delete</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="edit[]" type="checkbox" value="{{$child->modid}}" id="edit-{{$child->modid}}" class="form-check-input">
                                        <label class="form-check-label" for="edit-{{$child->modid}}">edit</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="create[]" type="checkbox" value="{{$child->modid}}" id="create-{{$child->modid}}" class="form-check-input">
                                        <label class="form-check-label" for="create-{{$child->modid}}">create</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="view[]" type="checkbox" value="{{$child->modid}}" id="view-{{$child->modid}}" class="form-check-input">
                                        <label class="form-check-label" for="view-{{$child->modid}}">view</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="module-list">
                            <div>{{$value->mod_name}}</div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input name="delete[]" type="checkbox" value="{{$value->modid}}" id="delete-{{$value->modid}}" class="form-check-input">
                                    <label class="form-check-label" for="delete-{{$value->modid}}">delete</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="edit[]" type="checkbox" value="{{$value->modid}}" id="edit-{{$value->modid}}" class="form-check-input">
                                    <label class="form-check-label" for="edit-{{$value->modid}}">edit</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="create[]" type="checkbox" value="{{$value->modid}}" id="create-{{$value->modid}}" class="form-check-input">
                                    <label class="form-check-label" for="create-{{$value->modid}}">create</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="view[]" type="checkbox" value="{{$value->modid}}" id="view-{{$value->modid}}" class="form-check-input">
                                    <label class="form-check-label" for="view-{{$value->modid}}">view</label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-sm-9 offset-sm-3">
                        <input type="hidden" name="guid" value="{{$data->guid}}">
                        <button class="btn btn-success btn-sm text-light" type="submit"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Save</button>
                        <a class="btn btn-danger btn-sm text-light form-action-cancel" data-href="{{ url(route('employee-group')) }}"><i class="fas fa-times"></i>&nbsp;&nbsp;&nbsp;Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('customJs')
    <script type="text/javascript">
        $(function(){
            let role_view 	= {!! json_encode(explode(',',$data->read)) !!};
            let role_create = {!! json_encode(explode(',',$data->create)) !!};
            let role_alter 	= {!! json_encode(explode(',',$data->update)) !!};
            let role_drop 	= {!! json_encode(explode(',',$data->delete)) !!};

            $.each(role_view, function(i,v){
                $('#view-'+v).prop('checked', true);
            });
            $.each(role_create, function(i,v){
                $('#view-'+v).prop('checked', true);
                $('#create-'+v).prop('checked', true);
            });
            $.each(role_alter, function(i,v){
                $('#view-'+v).prop('checked', true);
                $('#edit-'+v).prop('checked', true);
            });
            $.each(role_drop, function(i,v){
                $('#view-'+v).prop('checked', true);
                $('#delete-'+v).prop('checked', true);
            });

            $('input:checkbox').click(function(){
                var value = $(this).val();
                if($(this).attr('name') == 'create[]' || $(this).attr('name') == 'edit[]' || $(this).attr('name') == 'delete[]'){
                    if(!$('#view-'+value).is(':checked')){
                        $('#view-'+value).prop('checked', true);
                    }
                }
                if($(this).attr('name') == 'view[]'){
                    if(!$(this).is(':checked')){
                        $('#create-'+value).prop('checked', false);
                        $('#edit-'+value).prop('checked', false);
                        $('#delete-'+value).prop('checked', false);
                    }
                }
            });
        });
    </script>
@endpush

