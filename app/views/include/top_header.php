<div class="topheader">
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
        <div class="row">
        <div class="col-md-4"><div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url().'btPublic/html/'?>images/logo-profree.png" /></a>
        </div></div>

        <div class="col-md-8"><div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">        	
            <li <?=selectLinkTop($this->uri->segment(2), 'Sale')?>><a href="<?=base_url().'property/Sale'?>">Sell</a> </li>                    
            <li <?=selectLinkTop($this->uri->segment(2), 'Rent')?>><a href="<?=base_url().'property/Rent'?>">Rent</a></li>
            <li <?=selectLinkTop($this->uri->segment(2), 'Wanted')?>><a href="<?=base_url().'property/Wanted'?>">Wanted</a></li>
            <li <?=selectLinkTop($this->uri->segment(2), 'Commercial')?>><a href="<?=base_url().'property/Commercial'?>">Commercial</a></li>
            <li <?=selectLinkTop($this->uri->segment(1), 'agents')?>><a href="<?=base_url().'agents'?>">Agents</a></li>
       	</ul>
        </div></div><!--/.nav-collapse -->             
        </div>

        </div>
        </div>
</div>