 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy;  {{ date('Y') }} <a href="https://adminlte.io">God</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>


  <!-- jQuery 3 -->
{{ Html::script("backend/bower_components/jquery/dist/jquery.min.js") }}
<!-- jQuery UI 1.11.4 -->
{{ Html::script("backend/bower_components/jquery-ui/jquery-ui.min.js") }}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
{{ Html::script("backend/bower_components/bootstrap/dist/js/bootstrap.min.js") }}
<!-- Morris.js charts -->
{{ Html::script("backend/bower_components/raphael/raphael.min.js") }}
{{ Html::script("backend/bower_components/morris.js/morris.min.js") }}
<!-- Sparkline -->
{{ Html::script("backend/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js") }}
<!-- jvectormap -->
{{ Html::script("backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js") }}
{{ Html::script("backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js") }}
<!-- jQuery Knob Chart -->
{{ Html::script("backend/bower_components/jquery-knob/dist/jquery.knob.min.js") }}
<!-- daterangepicker -->
{{ Html::script("backend/bower_components/moment/min/moment.min.js") }}
{{ Html::script("backend/bower_components/bootstrap-daterangepicker/daterangepicker.js") }}
<!-- iCheck for checkboxes and radio inputs -->
{{ Html::script("backend/plugins/iCheck/icheck.min.js") }}
<!-- datepicker -->
{{ Html::script("backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") }}
<!-- Bootstrap WYSIHTML5 -->
{{ Html::script("backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}
<!-- Slimscroll -->
{{ Html::script("backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js") }}
<!-- FastClick -->
{{ Html::script("backend/bower_components/fastclick/lib/fastclick.js") }}
<!-- AdminLTE App -->
{{ Html::script("backend/dist/js/adminlte.min.js") }}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- {{ Html::script("backend/dist/js/pages/dashboard.js") }} -->
<!-- AdminLTE for demo purposes -->
{{ Html::script('backend/plugins/toster/toster.min.js') }}
{{ Html::script("backend/dist/js/demo.js") }}
{{ Html::script('backend/js/timeout.js') }}

@yield('js')
@livewireScripts
<script type="text/javascript">

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    var root = '{{url("/")}}';

    $(document).ready(function(){

    $('#success').delay(3000).fadeOut('slow');
    $('#danger').delay(3000).fadeOut('slow');
    $('#warning').delay(3000).fadeOut('slow');

    var logout_url = "<?=URL::route('admin.logout')?>";
    var redirUrl = "<?=URL::route('admin.locked')?>";

    $.sessionTimeout({
        logoutUrl       : logout_url,
        redirUrl        : redirUrl,
        warnAfter       : 1850000,
        redirAfter      : 7000,
        keepAlive       : false,
        countdownMessage: 'Otherwise You will be redirected to login page in {timer} seconds.',
        ignoreUserActivity: false
    });
    });
    $.ajaxSetup({
    statusCode: {
        401: function() {
            swal({
               title: "Session Timeout",
               type:"error",
               timer: 500000,
               showConfirmButton: false
            });
        }
    }
    });

    window.addEventListener('swal:modal', event => { 
        swal({
        title: event.detail.message,
        text: event.detail.text,
        icon: event.detail.type,
        });
    });
</script>