
<div class="table-responsive">
    <table class="table" id="cars-table">
        <thead>
            <tr>
                <th>Id User</th>
        <th>Name</th>
        <th>Brand</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
            <tr>
                <td>{{ $car->id_user }}</td>
            <td>{{ $car->name }}</td>
            <td>{{ $car->brand }}</td>
                <td width="175">
                    {!! Form::open(['route' => ['cars.destroy', $car->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cars.show', [$car->id]) }}" class='btn btn-default btn-xs showButton'>
                            Show
                        </a>
                        <a href="{{ route('cars.edit', [$car->id]) }}" class='btn btn-default btn-xs editButton'>
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