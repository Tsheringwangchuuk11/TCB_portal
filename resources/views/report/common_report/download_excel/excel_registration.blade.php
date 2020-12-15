<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Citizen ID</th>
            <th>Name</th>
            <th>License No.</th>
            <th>Star Category</th>
            <th>Hotel Name</th>
            <th>Validity Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($registrationlists as $registrationlist)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$registrationlist->cid_no}}</td>
            <td>{{$registrationlist->owner_name}}</td>
            <td>{{$registrationlist->license_no}}</td>
            <td>{{$registrationlist->star_category_name}}</td>
            <td>{{$registrationlist->tourist_standard_name}}</td>
            <td>{{$registrationlist->validaty_date}}</td>
        </tr>
        @endforeach
    </tbody>
</table>