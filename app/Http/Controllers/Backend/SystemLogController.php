<?php
namespace App\Http\Controllers\Backend;

use App\Exceptions\ServiceException;
use Illuminate\Http\Request;

class SystemLogController extends BaseController{

    public function index() {
        $root = storage_path('logs');
        $ignore = ['..', '.', '.gitignore'];
        $getFiles = function ($path) use (&$getFiles, $ignore, $root) {
          $arr = [];
          $files = scandir($root . $path);
          foreach ($files as $file) {
              if(in_array($file, $ignore)) {
                  continue;
              }
              $relPath = $path.$file;
            if(is_dir($root. $relPath)) {
                $arr[] = [
                    'name'=> $file,
                    'children' => $getFiles($relPath."/"),
                    'path'=>$relPath
                ];
            } else {
                $arr[] = [
                    'name'=> $file,
                    'path'=>$relPath
                ];
            }
          }
          return $arr;
        };
        return $getFiles('/');
    }

    public function content(Request $request) {
        $path = $request->path;
        $root =  $root = storage_path('logs');
        $file = $root . $path;
        if(!is_file($file)) {
           throw new ServiceException('日志不存在', 500);
        }
        $content = '';
        $page = $request->input('page', 1);
        $size = $request->input('size', 200);
        $start = ($page - 1) * $size;
        $fp = new \SplFileObject($file);
        $fp->seek($start);
        for ($i= 1; $i<= $size; $i++) {
            $content .= $fp->current();
            if(!$fp->eof()) {
                $fp->next();
            }
        }
        if($content === '') {
            $content = [];
        } else {
            $content = explode("\n", $content);
        }
        return $this->success($content);
    }

    public function destroy(Request $request) {
        $file = storage_path('logs') . $request->path;
        $ignore = ['..', '.', '.gitignore'];
        if(!is_file($file)) {
            throw new ServiceException('日志不存在');
        }
        $fileObj = new \SplFileInfo($file);
        if(in_array($fileObj->getFilename(), $ignore)) {
            throw new ServiceException('非法的日志路径');
        }
        if( unlink($file)) {
            return $this->success();
        }else {
            return $this->fail('删除失败', 500);
        }

    }
}
