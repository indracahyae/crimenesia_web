<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="url" content="{{url('/')}}" />

    <!-- Site Properties -->
    <title>Login Police</title>
    <link rel="stylesheet" href="{{asset('css/police.css')}}">

</head>

<body class="police-login-body">

    <div class="ui centered card">
      <div class="content">
        
        <img class="right floated mini ui image" src="{{asset('img/police_logo.png')}}">
        <div class="header centered">Crimenesia</div>
        <div class="meta">Police Gate</div>
        <div class="description">
          <form class="ui form login">
            <div class="field">
              <input id="nrp" type="text" name="nrp" placeholder="NRP">
            </div>
            <div class="field">
              <input id="password" type="password" name="password" placeholder="Password">
            </div>
            <div class="field">
            </div>
            <button class="fluid ui teal button login">Login</button>
          </form>
        </div>
      </div>
      <div class="extra content">
        <a href="#" class="btnSignUp">
          <i class="user outline teal icon"></i>
          Sign Up
        </a>
      </div>
    </div>

  <!-- modal reg Data Masyarakat -->
    <div class="ui modal regPoliceDataMasyarakat">
      <i class="close icon"></i>
      <div class="header titleContainerLable">
        Society Data
      </div>
      <div class="content">
        <form class="ui form regPoliceDataMasyarakat" >
            <!-- <input type="hidden" value="" name="key" id="keySekolah"> -->
            <div class="field">
                <label>NIK</label>
                <input type="number" name="nik" id="" placeholder="NIK">
            </div>
            <div class="field">
                <label>Password</label>
                <input type="text" name="password" id="" placeholder="Password">
            </div>
            <div class="field">
                <label>Nama</label>
                <input type="text" name="nama" id="" placeholder="Nama">
            </div>
            <div class="field">
              <label>Jenis Kelamin</label>
              <select class="ui dropdown jenis_kelamin" name="jenis_kelamin" id="">
                <option value="">...</option>
                <option value="1">Laki-laki</option>
                <option value="2">Perempuan</option>
              </select>
            </div> 
            <div class="field">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="" placeholder="Tempat Lahir">
            </div>
            <div class="field">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="" placeholder="Tanggal Lahir">
            </div>
            <div class="field">
              <label>Kabupaten / Kota</label>
              <select class="ui search dropdown kota" name="id_kota" id="ddKota">
                
              </select>
            </div>
            <div class="field">
                <label>Alamat</label>
                <input type="text" name="alamat" id="" placeholder="Alamat">
            </div>
            <div class="field">
              <label>Agama</label>
              <select class="ui dropdown agama" name="agama" id="">
                <option value="">...</option>
                <option value="0">Islam</option>
                <option value="1">Kristen</option>
                <option value="2">Hindu</option>
                <option value="3">Buddha</option>
                <option value="4">Konghucu</option>
              </select>
            </div>
            <div class="field">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" id="" placeholder="Pekerjaan">
            </div>
            <div class="field">
                <label>Tlp.</label>
                <input type="number" name="tlp" id="" placeholder="Telephone Number">
            </div>
            <div class="field">
                <label>Email</label>
                <input type="text" name="email" id="" placeholder="Email">
            </div>
            <div class="field">
                <label>Photo</label>
                <input type="file" name="foto" id="" placeholder="">
            </div>
        </form>
      </div>
      <div class="actions">
        <div class="ui button btnRegPolice" style="user-select: auto;">Skip</div>
        <div class="ui primary button saveRegPoliceDataMasyarakat" style="user-select: auto;">Submit</div>
      </div>
    </div>

    <!-- modal reg Data Police -->
    <div class="ui modal regPolice">
      <i class="close icon"></i>
      <div class="header titleContainerLable">
        Police Data
      </div>
      <div class="content">
        <form class="ui form regPolice" >
            <!-- <input type="hidden" value="" name="key" id="keySekolah"> -->
            <div class="field">
                <label>NRP</label>
                <input type="number" name="nrp" id="" placeholder="">
            </div>
            <div class="field">
                <label>Pangkat Polisi</label>
                <select class="ui dropdown pangkatPolisi" name="pangkat_polisi" id="">
                  <option value="">...</option>
                  <option value="0">Bhayangkara Dua</option>
                  <option value="1">Bhayangkara Satu</option>
                  <option value="2">Bhayangkara Kepala</option>
                  <option value="3">Ajun Brigadir Polisi Dua</option>
                  <option value="4">Ajun Brigadir Polisi Satu</option>
                  <option value="5">Ajun Brigadir Polisi</option>
                  <option value="6">Brigadir Polisi Dua</option>
                  <option value="7">Brigadir Polisi Satu</option>
                  <option value="8">Brigadir Polisi</option>
                  <option value="9">Brigadir Polisi Kepala</option>
                  <option value="10">Ajun Inspektur Polisi Dua</option>
                  <option value="11">Ajun Inspektur Polisi Satu</option>
                  <option value="12">Inspektur Polisi Dua</option>
                  <option value="13">Inspektur Polisi Satu</option>
                  <option value="14">Ajun Komisaris Polisi</option>
                  <option value="15">Komisaris Polisi</option>
                  <option value="16">Ajun Komisaris Besar Polisi</option>
                  <option value="17">Komisaris Besar Polisi</option>
                  <option value="18">Brigadir Jenderal Polisi</option>
                  <option value="19">Inspektur Jenderal Polisi</option>
                  <option value="20">Komisaris Jendral Polisi</option>
                  <option value="21">Jenderal Polisi</option>
                </select>
            </div>
            <div class="field">
                <label>Jabatan Polisi</label>
                <input type="text" name="jabatan_polisi" id="" placeholder="">
            </div>
            <div class="field">
                <label>NIK</label>
                <input type="number" name="nik" id="" placeholder="">
            </div>
            <div class="field">
                <label>Document</label>
                <input type="file" name="dokumen" id="" placeholder="">
            </div>
            <div class="field">
              <label>Kantor Polisi</label>
              <select class="ui search dropdown kantorPolisi" name="id_kantor_polisi" id="ddKantorPolisi">
                
              </select>
            </div>
        </form>
      </div>
      <div class="actions">
        <div class="ui button btnSignUp" style="user-select: auto;">Cancel</div>
        <div class="ui primary button saveRegPolice" style="user-select: auto;">Submit</div>
      </div>
    </div>

    <script src="{{asset('js/police.js')}}"></script>
</body>
</html>
