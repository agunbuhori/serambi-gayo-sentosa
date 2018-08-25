<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
<form method="post" action="{{ url('admin/add_barang_bawang_jadi') }}">
  @csrf
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>Add Form</div>
    <div class='panel-body'>
      <form method='post' action='{{CRUDBooster::mainpath('add-save')}}'>
        <div class="form-group">
          <label>Keterangan</label>
          <input class="form-control" type="text" name="keterangan" placeholder="Tulis keterangan" required="">
        </div>

        <div class='form-group'>
          <label>Induk Barang</label>
          <select class="form-control" id="barang_id" style="width: 100%" onchange="getChild(this)">
            <option value=''>** Please select a Induk Barang</option>
            @foreach ($barangs as $barang)
            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
            @endforeach
          </select>

        </div>

        <div class='form-group'>
          <label>Anak Barang</label>
          <select name="barang_id" class="form-control" id="barang_anak_id" style="width: 100%" required onchange="getChild2(this)">
            <option value=''>** Please select a Anak Barang</option>
          </select>

        </div>

        <div class='form-group'>
          <label>Kategori</label>
          <select name="kategori_id" class="form-control" id="kategori_id" style="width: 100%" required>
            <option value=''>** Please select a Kategori</option>
          </select>
        </div>

        <div class="form-group">
          <label>Gudang</label>
          @foreach ($gudangs as $gudang)
          <div class="radio">
            <label>
              <input type="radio" name="gudang_id" id="optionsRadios1" value="{{$gudang->id}}" checked="">
              Gudang {{$gudang->nama_gudang}}
            </label>
          </div>
          @endforeach
        </div>

        <div class="form-group" id="satuan">
          
        </div>
         
        <!-- etc .... -->
        
      </form>
    </div>
    <div class='panel-footer'>
      <input type='submit' class='btn btn-primary' value='Save changes'/>
    </div>
  </div>
</form>
@endsection