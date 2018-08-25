<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class="forn-inline" style="margin-bottom: 15px">
    <select class="form-control"></select>
  </div>
  <div class="box">
    <div class="box-header">
      
      <div class="pull-left">
        <h4>Relasi Satuan Material</h4>
      </div>

      <div class="pull-right">
        <button class="btn btn-primary">Simpan</button>
      </div>
    </div>
          @php
        $materials = DB::table('tb_material')->get();
        $satuans = DB::table('tb_satuan')->get();
        @endphp
    <div class="box-body no-padding">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nama Material</th>
            @foreach ($satuans as $satuan)
            <th align="center" style="width: 50px">{{ $satuan->nama_satuan }}</th>
            @endforeach 
          </tr>
        </thead>

        <tbody>
          @foreach ($materials as $material)
          <tr>
            <td>{{ $material->nama_material }}</td>
            @for ($i = 0; $i < count($satuans); $i++)
            <td align="center"><input type="checkbox"></td>
            @endfor
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script type="text/javascript">
    // alert(0)
  </script>
@endsection