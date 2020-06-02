<!--Counter Inbox-->
<?php
$id_admin=$this->session->userdata('idadmin');
$q=$this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_id='$id_admin'");
$c=$q->row_array();

$this->session->set_userdata('username', $c['pengguna_username']);

$inbox = $this->db->get_where('tbl_inbox', ['inbox_kontak' => $c['pengguna_username'], 'inbox_status' => '1'])->num_rows();
$siswa = $this->db->get_where('tbl_siswa',['siswa_nis' => $c['pengguna_username']])->row_array();
?>
<header class="main-header">

  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">SAP</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">Sekolah Anak Panah</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <?php if($c['pengguna_level'] != 1){ ?>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?= $inbox ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki <?= $inbox ?> pesan</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php 
                  $inbox=$this->db->query("SELECT tbl_inbox.*,DATE_FORMAT(inbox_tanggal,'%d %M %Y') AS tanggal FROM tbl_inbox WHERE inbox_status='1' ORDER BY inbox_id DESC LIMIT 5");
                  foreach ($inbox->result_array() as $in) :
                    $inbox_id = $in['inbox_id'];
                    $inbox_nama = $in['inbox_nama'];
                    $inbox_tgl = $in['tanggal'];
                    $inbox_pesan = $in['inbox_pesan'];
                    ?>
                    <li><!-- start message -->
                      <a href="<?php echo base_url().'inbox'?>">
                        <div class="pull-left">
                          <img src="<?php echo base_url().'assets/images/user_blank.png'?>" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          <?php echo $inbox_nama;?>
                          <small><i class="fa fa-clock-o"></i> <?php echo $inbox_tgl;?></small>
                        </h4>
                        <p><?php echo $inbox_pesan;?></p>
                      </a>
                    </li>
                    <!-- end message -->
                  <?php endforeach;?>
                </ul>
              </li>
              <li class="footer"><a href="<?php echo base_url().'inbox'?>">Lihat Semua Pesan</a></li>
            </ul>
          </li>
        <?php } ?>
        <?php if (empty($siswa['siswa_photo'])) {
                          $foto=base_url('assets/images/default_photo.jpg');
                        } 
                        else{
                         $foto=base_url().'assets/filesiswa/'.$c['pengguna_username'].'/'.$siswa['siswa_photo'];
                        }
                        ?>
        <?php $photo = ($c['pengguna_level']=='1') ? base_url().'assets/images/user_blank.png' : $foto ; 
        ?>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?= $photo ?>" class="user-image" alt="">
            <span class="hidden-xs"><?php echo $c['pengguna_nama'];?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">

              <img src="<?= $photo ?>" class="img-circle" alt="">

              <p>
                <?php echo $c['pengguna_nama'];?>
                <?php if($c['pengguna_level']=='1'):?>
                  <small>login</small>
                  <?php else:?>
                    <small>Siswa</small>
                  <?php endif;?>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url().'login/logout'?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo base_url().''?>" target="_blank" title="Lihat Website"><i class="fa fa-globe"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>