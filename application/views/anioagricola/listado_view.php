<?php $this->load->view('template/header'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Quick Example</h3>
                <!-- Custom Tabs -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">2008-2009</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">2009-2010</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">2010-2011</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">2011-2012</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>uno</th>
                                    <th>uno</th>
                                    <th>uno</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>uno</th>
                                    <th>uno</th>
                                    <th>uno</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">...</div>
                    <div role="tabpanel" class="tab-pane" id="messages">...</div>
                    <div role="tabpanel" class="tab-pane" id="settings">...</div>
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('template/footer'); ?>
