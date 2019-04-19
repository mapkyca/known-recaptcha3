<div class="row">

    <div class="col-md-10 col-md-offset-1">
	            <?=$this->draw('admin/menu')?>
        <h1>Recaptcha configuration</h1>

    </div>

</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <form action="<?=\Idno\Core\site()->config()->getDisplayURL()?>admin/recaptcha3/" class="form-horizontal" method="post">
            <div class="controls-group">
                <div class="controls-config">
                    <p>
			<?= \Idno\Core\Idno::site()->language()->_('Configure google recaptcha'); ?>
		    </p>
                    
                </div>
            </div>
            
            <div class="controls-group">
		
		<div class="row">
		    <div class="col-md-2">
			<p>
			    <label class="control-label" for="siteKey"><?= \Idno\Core\Idno::site()->language()->_('Recaptcha3 siteKey'); ?></label>
			</p>
		    </div>
		    <div class="col-md-4">
			<input type="text" id="siteKey" class="form-control" name="siteKey" value="<?=htmlspecialchars(\Idno\Core\site()->config()->recaptcha3['siteKey'])?>" >
		    </div>
		    <div class="col-md-6">
		    </div>
		</div>

                <div class="row">
		    <div class="col-md-2">
			<p>
			    <label class="control-label" for="privateKey"><?= \Idno\Core\Idno::site()->language()->_('Recaptcha3 privateKey'); ?></label>
			</p>
		    </div>
                
		    <div class="col-md-4">
			<input type="text" id="privateKey" class="form-control" name="privateKey" value="<?=htmlspecialchars(\Idno\Core\site()->config()->recaptcha3['privateKey'])?>" >
		    </div>
		    <div class="col-md-6">
		    </div>
		</div>
                
                    
            </div>
            
                        
            <div>

                <div class="controls-save">
                    <button type="submit" class="btn btn-primary"><?= \Idno\Core\Idno::site()->language()->_('Save settings'); ?></button>
                </div>
            </div>

            <?= \Idno\Core\site()->actions()->signForm('/admin/recaptcha3/')?>
        </form>
    </div>
</div>