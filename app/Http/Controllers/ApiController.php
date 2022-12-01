<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function read(){
        $students = Student::select('fname','lname','email','phone','Adress','password')->get();
        return response()->json([
            'status'=>200,
            'student'=> $students,
        ]);
    }


    //
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'fname'=>'required|min:3|max:15',
            'lname'=>'required|min:3|max:10',
            'email'=>'required|email|max:25',
            'phone'=>'required|min:10|max:12',
            'Adress'=>'required|min:5|max:500',
            'password'=>'required|min:5|max:15',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'message'=> $validator->messages()
            ],400);
        }else{
            $students = new Student();

            $students->fname = $request->input('fname');
            $students->lname = $request->input('lname');
            $students->email = $request->input('email');
            $students->phone = $request->input('phone');
            $students->Adress = $request->input('Adress');
            $students->password = $request->input('password');
    
            $students->save();
            return response()->json([
                'status'=>200,
                'message'=> 'Created Successfully'
            ],200);
        }




    }

    //
    public function show($id){
        $students = Student::find($id);
        if($students){

            return response()->json([
                'status'=>200,
                'student'=> $students,
            ],200);
        }else{

            return response()->json([
                'status'=>404,
                'student'=> 'Not Found',
            ],404);
        }

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'fname'=>'required|min:3|max:15',
            'lname'=>'required|min:3|max:10',
            'email'=>'required|email|max:25',
            'phone'=>'required|min:10|max:12',
            'Adress'=>'required|min:5|max:500',
            'password'=>'required|min:5|max:15',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'message'=> $validator->messages()
            ],400);
        }
        else{

        $students = Student::find($id);
        if($students)
        {
            $students->fname = $request->fname;
            $students->lname = $request->lname;
            $students->email = $request->email;
            $students->phone = $request->phone;
            $students->Adress = $request->Adress;
            $students->password = $request->password;

            $students->update();
            return response()->json([
                'status'=>200,
                'student'=> 'Updated Successfully',
            ],200);
            

        }
        else{
            return response()->json([
                'status'=>404,
                'student'=> 'Not Found',
            ],404);
        }
    }
    }


    public function delete($id){

        $students = Student::find($id);
        if($students)
        {
            $students->delete();
            return response()->json([
                'status'=>200,
                'student'=> 'Delete successfully',
            ],200);

        }
        else{
            return response()->json([
                'status'=>404,
                'student'=> 'Not Found',
            ],404);
        }
    }
}
