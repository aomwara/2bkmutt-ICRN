@extends('layouts.app')

@section('title', 'First Time Registration')

@section('content')
    @include('components.title', [
        "title" => "First Time Registration",
        "desc" => "for International Student"
    ])
    <?php
        $user = App\UserProfile::where("camp_id", "=", $camp_id)->get()->first();
        $generateFields = array(
            [
                "name" => "",
                "display" => "",
                "html" => '<p style="color: red;" class="form-control-static">* Required</p>'
            ],
            [
                "name" => "",
                "display" => "",
                "html" => '<p style="font-size: 16px;" class="form-control-static">Personal Information</p>'
            ],
            [
                "name" => "camp_id",
                "display" => "2B-KMUTT ID",
                "html" => '<p class="form-control-static">' . $user->camp_id . '</p><input type="hidden" name="camp_id" id="form_camp_id" value='.$user->camp_id.'>'
            ],
            [
                "name" => "gender",
                "display" => "Gender",
                "html" => '
                    <label class="radio-inline">
                      <input type="radio" name="gender" id="form_gender" value="M" '. (($user->gender == "M")? 'checked': '') .' > Male
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="gender" id="form_gender" value="F" '. (($user->gender == "F")? 'checked': '') .' > Female
                    </label>
                ',
                "required" => true
            ],
            [
                "name" => "title",
                "display" => "Title",
                "required" => true
            ],
            [
                "name" => "first_name-en",
                "display" => "First Name",
                "required" => true
            ],
            [
                "name" => "last_name-en",
                "display" => "Last Name",
                "required" => true
            ],
            [
                "name" => "nickname-en",
                "display" => "Nickname (P'Staff name it for you)",
                "required" => true
            ],
            [
                "name" => "self_telephone_no",
                "display" => "Telephone Number(Thai Number)",
                "required" => true,
                "help" => "No need to put - between the number"
            ],
            [
                "name" => "birth_date",
                "display" => "Birhdate",
		"html" => '
		<div class="input-group date">
  			<input type="text" class="form-control" value="' . $user->birth_date . '" name="birth_date"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		</div>',
                "required" => true
            ],
            [
                "name" => "school",
                "display" => "School Name",
                "required" => true
            ],
            [
                "name" => "grade",
                "display" => "Education Level:",
                "html" => '
                    <label class="radio-inline">
                      <input type="radio" name="grade" id="form_grade" value="ม.4" '. (($user->grade == "ม.4")? 'checked': '') .' > Grade 10
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="grade" id="form_grade" value="ม.5" '. (($user->grade == "ม.5")? 'checked': '') .' > Grade 11
                    </label>
                ',
                "required" => true
            ],
	    [
		"name" => "religion",
		"display" => "Religion",
		"placeholder" => "-"

	    ],
            [
                "name" => "disease",
                "display" => "disease",
                "placeholder" => "-"
            ],
            [
                "name" => "allergic",
                "display" => "allergic",
                "placeholder" => "-"
            ],
            [
                "name" => "email",
                "display" => "Email",
                "help" => "Please use your current email for register.",
                "required" => true
            ],
            [
                "name" => "facebook",
                "display" => "Facebook",
                "help" => "Personal Facebook example:John Doe"
            ],
            [
                "name" => "",
                "display" => "",
                "html" => '<p style="font-size: 16px;" class="form-control-static">ข้อมูลผู้ปกครอง (Staff need to type this for you.)</p>'
            ],
            [
                "name" => "parent_first_name-th",
                "display" => "ชื่อจริงผู้ปกครอง (staff name)",
                "required" => true
            ],
            [
                "name" => "parent_last_name-th",
                "display" => "นามสกุลผู้ปกครอง (staff lastname)",
                "required" => true
            ],
            [
                "name" => "parent_telephone_no",
                "display" => "เบอร์โทรศัพท์ผู้ปกครอง (Staff Telephone Number)",
                "required" => true
            ]
        );
    ?>
    <h5>Step 3: Edit your information</h5><br>
    <form action="{{ url('/magic/first-time-registration/register') }}" method="post" class="form-horizontal">
        <form class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @foreach( $generateFields as $field )
            <div class="form-group">
                <label for="{{ $field['name'] }}" class="col-sm-3 control-label">{{ $field['display'] }} {{ (isset($field['required'])? " *": "") }}</label>
                <div class="col-sm-9">
                    <?php
                        if(isset($field['html'])){
                            echo $field['html'];
                        }else{
                            echo '<input
                                    type="text"
                                    class="form-control"
                                    '.( (isset($field['required']))? ' required ':'' ).'
                                    name="'.$field['name'].'"
                                    id="form_'.$field['name'].'"
                                    placeholder="'.( (isset($field['placeholder']) )? $field['placeholder']: str_replace("*", "", $field['display']) ) .'"
                                    value="'.$user[$field['name']].'">';
                        }
                        if( isset($field['help']) ) echo '<p class="help-block">'.$field['help'].'</p>';
                    ?>
                </div>
            </div>
        @endforeach
        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
                <p style="color: red;" class="form-control-static"><i class="fa fa-exclamation-triangle"></i> Please check all of the detail before submit.</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
<script type='text/javascript' src="/js/jquery-3.3.1.js"></script>
<script type='text/javascript' src="/js/jquery-ui.js"></script>
<script type='text/javascript' src="/js/bootstrap-datepicker.js"></script>
<script type='text/javascript'>
$('.input-group.date').datepicker({
    calendarWeeks: true,
    todayHighlight: true,
    autoclose: true,
    dateFormat: 'yy-mm-dd'
});  

</script>
@endsection

@section('footer')

@endsection

