@if(!empty($data))
<url>
  <loc>{{ $data['loc'] }}</loc>
  <changefreq>{{ $data['changefreq']}}</changefreq>
  <priority>{{ $data['priority'] }}</priority>
</url>
@endif