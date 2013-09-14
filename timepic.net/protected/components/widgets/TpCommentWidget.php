<?php
class TpCommentWidget extends CWidget
{   
	public $id = '';
	public $idtype = '';
	public $htmlOptions = array();
	public $action = '';
	public $msgs = '';
	public $pages = '';
	
    public function init()  
    {  
		$sql = "SELECT *  FROM {{comment}} WHERE id=:id AND idtype=:idtype ORDER BY dateline DESC LIMIT 10";
		$query = Yii::app()->db->createCommand($sql);
		$query->bindParam(':id', $this->id);
		$query->bindParam(':idtype', $this->idtype);
		$result = $query->query()->readAll();
		$this->msgs=$result;
    }  
   
    public function run()  
    {  
		$model = new Comment();
        //当视图中执行$this->endWidget()的时候会执行这个方法  
        //可以在这里进行渲染试图的操作，注意这里提到的视图是widget的视图  
        //注意widget的视图是放在跟widget同级的views目录下面，例如下面的视图会放置在  
        //  /protected/widget/test/views/test.php  
		if (!$this->htmlOptions['id']) {
			$this->htmlOptions['id'] = 'commentWidget';
		}
        $this->render('TpCommentWidget', array(  
            'idtype' => $this->idtype,  
            'id' => $this->id,  
			'model' => $model,
			'action' => $this->action,
			'msgs' => $this->msgs,
			'htmlOptions' => $this->htmlOptions,
        ));
    }  
} 
?>
