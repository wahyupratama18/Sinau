<!DOCTYPE html>
<html>
<head>
    <title>Assignment</title>
    @livewireStyles
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    
<div class="container">
    
    <div class="card">
      <div class="card-header">
        masukkan text dan pilih file
      </div>
      <div class="card-body">
        @livewire('file-upload')
      </div>
    </div>
        
</div>
    
</body>
  
@livewireScripts
  
</html>