<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Message;
use App\Http\Requests\BackEnd\Messages\Store;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyContact;

class Messages extends BackEndController
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }

    public function replay($id, Store $request)
    {
        $message = $this->model->findOrFail($id);
        Mail::send(new ReplyContact($message, $request->message));
        // dd( $request->message);
        return redirect()->back();
    }
}
