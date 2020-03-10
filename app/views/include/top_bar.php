<div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col-md-4"><a href="<?=base_url()?>property/add">Post a New Property</a></div>
            <div class="col-md-8">            	
                <?php
				if(isLogin()){
					echo '<a href="'.base_url().'dashboard">Dashboard</a>';
					if(isSuperAdmin()){
						echo '<a href="'.base_url().'admin/agents/update/1">Change Profile Settings</a>';
					}
					echo '<a href="'.base_url().'property/user_listing">My Properties</a>';
					echo '<a href="'.base_url().'logout">Logout</a>';
				}
				else{
					echo '<a href="'.base_url().'login">Login</a>';
					echo '<a href="'.base_url().'register">Register</a>';
					echo '<a href="'.base_url().'login">My Properties</a>';
				}
				?>
            </div>
        </div>
    </div>
</div>