@extends('layouts.smartadmin.app')

@section('content')

    <h1>Pets: All</h1>
    <div class="row">
        <a href="/admin/pets/create">
            <button class="btn btn-block btn-primary">
                <i class="fa fa-wrench"></i> Create New
            </button>
        </a>

        <table class="table table-responsive table-striped table-bordered">
            <thead>
            <tr>
                <td>Name</td>
                <td>Owner</td>
                <td>Weight</td>
                <td>Activity Level</td>
                <td>Species</td>
                <td>Breed</td>
                <td>Birthday</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($pets as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->owner->name }}</td>
                    <td>{{ $pet->weight }} lb</td>
                    <td>{{ $pet->activity_level }} %</td>
                    <td>{{ $pet->species }}</td>
                    <td>{{ $pet->breed }}</td>
                    <td>{{ $pet->birthday }}</td>
                    <td>
                        <a href="/admin/pets/{{ $pet->id }}/edit">
                            <button class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </a>

                        <form action="/admin/pets/{{ $pet->id }}" method="POST">
                            <?= csrf_field() ?>
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="pet_id" type="hidden" value="{{ $pet->id }}">
                            <button class="btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>

@endsection