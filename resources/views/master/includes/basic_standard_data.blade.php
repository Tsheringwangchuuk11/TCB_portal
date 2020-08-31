@if(isset($starCategories))
    @foreach($starCategories as $starCategory)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>
                <input type="hidden" name="checklistStandards[{{ $loop->iteration}}][star_category_id]" value="{!! $starCategory->id !!}">
                {!! $starCategory->star_category_name !!}
            </td>
            <td>
                <select name="checklistStandards[{{ $loop->iteration}}][basic_standard]" class="form-control resetKeyForNew select2bs4">
                    <option value="">Select Basic Standard</option>
                    @foreach ($basicStandards as $basicStandard)
                        <option value="{{ $basicStandard->id }}" data-id={{ $basicStandard->id }} data-name="{{ $basicStandard->standard_code }}">{{ $basicStandard->standard_code }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select  name="checklistStandards[{{ $loop->iteration}}][mandatory]" class="form-control resetKeyForNew select mandatory">
                    <option value="">-Select-</option>
                    @foreach (Config::get('settings.status') as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select  name="checklistStandards[{{ $loop->iteration}}][status]" class="form-control resetKeyForNew select status">
                    <option value="">-Select-</option>
                    @foreach (Config::get('settings.status') as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    @endforeach
@endif
