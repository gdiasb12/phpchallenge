@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">PHP CHALLENGE - XML FILES
          <hr>
          <form method="post" action="{{ route('document.store') }}" enctype="multipart/form-data">
           @csrf
           <div class="row m-b-1">
            <div class="col">
              {{-- <button type="button" class="btn btn-primary btn-block" onclick="document.getElementById('xmlfile').click()">Select the XML Document</button> --}}
              <div class="form-group inputDnD">
                <label class="sr-only" for="xmlfile">Select the XML Document</label>
                <input type="file" class="form-control-file text-primary font-weight-bold" required="required" name="xmlfile" id="xmlfile" accept="text/xml" onchange="readUrl(this)" data-title="Drag and Drop a XML file"/>

              </div>
            </div>
          </div>
          <hr>
          <input type="submit" class="btn btn-primary" value="Upload it!" />
        </form>
      </div>
      <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif
        <table class="table table-sm table-striped table-condensed">
          <thead>
            <tr>
              <th>Document</th>
              <th style="width: 250px;" class="text-center">#</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($documents as $document)
            <tr>
              <td>{{ $document->filename }}</td>
              <td class="text-center">
                <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
                  <a class="btn btn-primary" target="_blank" href="{{ $document->link }}">
                    View
                  </a>

                  <button type="submit" onclick="destroyDocument(this)" data-route="{{ route('document.destroy', $document->id) }}" class="btn btn-danger btn-destroy">
                    Remove
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
</div>    
<form id="frm_destroy" method="POST" action="">
 @csrf
 {{ method_field('DELETE') }}
</form>
@endsection
<script>
  function destroyDocument(el)
  {
    var route = el.getAttribute('data-route');   
    var form = document.getElementById('frm_destroy');
    form.setAttribute('action', route);
    form.submit();
  }
  function readUrl(input) {
    var value = input.value;
    var res = value.substr(value.lastIndexOf('.')) == '.xml';
    if (!res) {
      input.value = "";
      return res;
    }

    if (input.files && input.files[0]) {
      let reader = new FileReader();
      reader.onload = (e) => {
        let xmlData = e.target.result;
        let xmlName = input.files[0].name;
        input.setAttribute("data-title", xmlName);
      }
      reader.readAsDataURL(input.files[0]);
    }

  }
</script>