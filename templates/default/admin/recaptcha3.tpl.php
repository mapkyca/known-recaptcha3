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
			<?= \Idno\Core\Idno::site()->language()->_('To configure Google Recaptcha3 support, go <a href="%s" target="_blank">here</a> to obtain your tokens, and then enter them in the fields below.', ['https://g.co/recaptcha/v3']); ?>
		    </p>
                    
                </div>
            </div>
            
            <div class="controls-group">
		
		<div class="row">
		    <div class="col-md-10">
			<h3><?= \Idno\Core\Idno::site()->language()->_('Configure site keys'); ?></h3>
		    </div>
		</div>
		
		<div class="row">
		    <div class="col-md-2">
			<p>
			    <label class="control-label" for="siteKey"><?= \Idno\Core\Idno::site()->language()->_('Site Key'); ?></label>
			</p>
		    </div>
		    <div class="col-md-4">
			<input type="text" id="siteKey" class="form-control" name="siteKey" value="<?=htmlspecialchars(\Idno\Core\site()->config()->recaptcha3['siteKey'])?>" >
		    </div>
		    <div class="col-md-6">
			<p class="config-desc"><?= \Idno\Core\Idno::site()->language()->_('Public Recaptcha3 site key'); ?></p>
		    </div>
		</div>

                <div class="row">
		    <div class="col-md-2">
			<p>
			    <label class="control-label" for="privateKey"><?= \Idno\Core\Idno::site()->language()->_('Private Key'); ?></label>
			</p>
		    </div>
                
		    <div class="col-md-4">
			<input type="text" id="privateKey" class="form-control" name="privateKey" value="<?=htmlspecialchars(\Idno\Core\site()->config()->recaptcha3['privateKey'])?>" >
		    </div>
		    <div class="col-md-6">
			<p class="config-desc"><?= \Idno\Core\Idno::site()->language()->_('Public Recaptcha3 private key'); ?></p>
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