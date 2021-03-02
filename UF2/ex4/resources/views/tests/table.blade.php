<div class="table-responsive">
    <table class="table" id="tests-table">
        <thead>
            <tr>
                <th>Jajajaja</th>
        <th>Nonono</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tests as $test)
            <tr>
                <td>{{ $test->jajajaja }}</td>
            <td>{{ $test->Nonono }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['tests.destroy', $test->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tests.show', [$test->id]) }}" class='btn btn-default btn-xs showButton'>
                            Show
                        </a>
                        <a href="{{ route('tests.edit', [$test->id]) }}" class='btn btn-default btn-xs editButton'>
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
