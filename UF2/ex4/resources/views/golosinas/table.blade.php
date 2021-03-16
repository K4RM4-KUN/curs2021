<div class="table-responsive">
    <table class="table" id="golosinas-table">
        <thead>
            <tr>
                
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($golosinas as $golosina)
            <tr>
                
                <td width="120">
                    {!! Form::open(['route' => ['golosinas.destroy', $golosina->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('golosinas.show', [$golosina->id]) }}" class='btn btn-default btn-xs showButton'>
                            Show
                        </a>
                        <a href="{{ route('golosinas.edit', [$golosina->id]) }}" class='btn btn-default btn-xs editButton'>
                            Edit
                        </a>
                        {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs deleteButton', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
