<?php
namespace App\Actions\UserDocument;
use App\Models\UserDocument;

class DeleteUserDocument
{
  public function execute($fileableId)
  {
    return UserDocument::where('fileable_id', $fileableId)->delete();
  }
}