<?php
/*
namespace AppBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Handler\UploadHandler;

class ExternalFileUploader
{

private $uploadHandler;
private $kernelRootDir;


public function __construct(UploadHandler $uploadHandler, $kernelRootDir)
{
    $this->uploadHandler = $uploadHandler;
    $this->kernelRootDir = $kernelRootDir;
}

public function modExternalFile($url, $entity)
{

    $newfile = $this->kernelRootDir.'/../files/';

    copy($url, $newfile);
    $mimeType = mime_content_type($newfile);
    $size = filesize ($newfile);
    $finalName = md5(uniqid(rand(), true)).".jpg";

    $uploadedFile = new UploadedFile($newfile,$finalName,$mimeType, $size);

    $entity->setImageFile($uploadedFile);
    $this->uploadHandler->upload($entity,'imageFile');


}
}*/