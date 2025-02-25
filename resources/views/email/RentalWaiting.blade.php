<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
            <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Car Rental</a>
        </div>
        <p style="font-size:1.1em">Hi {{$user->name}},</p>
        <p>Your request for booking a Car with following detiails has been sent. We will reply with confirmation soon:</p>
        <p style="margin-bottom: 2px;">Customer Name: {{$user->name}}</p>
        <p style="margin-bottom: 2px;">Car Name: {{$car->name}}</p>
        <p style="margin-bottom: 2px;">Brand: {{$car->brand}}</p>
        <p style="margin-bottom: 2px;">Model: {{$car->model}}</p>
        <p style="margin-bottom: 2px;">Type: {{$car->car_type}}</p>
        <p style="margin-bottom: 2px;">Start Date: {{$start_date}}</p>
        <p style="margin-bottom: 2px;">End Date: {{$end_date}}</p>
        <p style="margin-bottom: 2px;">Total Cost: TK{{$cost}}</p>

        <p style="font-size:0.9em;">Regards,<br />Car Rental</p>
        <hr style="border:none;border-top:1px solid #eee" />
        <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
            <p>Md Mahfoozur Rahman</p>
            <p>204 East Kafrul</p>
            <p>Dhaka Bangladesh</p>
        </div>
    </div>
</div>
