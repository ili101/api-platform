$Uri = 'https://localhost/'
$ContentType = 'application/ld+json'
$Headers = @{ accept = 'application/ld+json' }

$Body = @"
{
  "name": "string",
  "subs": [
    {
      "name": "string",
      "tip": "/tips/1"
    }
  ]
}
"@ | ConvertFrom-Json | ConvertTo-Json
$Action = Invoke-RestMethod -Uri ($Uri + 'mains') -ContentType $ContentType -Headers $Headers -Method Post -Body $Body | ConvertTo-Json | ConvertFrom-Json -AsHashtable
$ActionId = $Action.id
$SubId = $Action.subs[0].id

$Body = @"
{
  // "@context": "/contexts/Main",
  "@id": "/mains/$ActionId",
  // "@type": "Main",
  // "id": $ActionId,
  "name": "string",
  "subs": [
    {
      "@id": "/subs/$SubId",
      // "@type": "Sub",
      // "id": $SubId,
      "name": "string",
      "tip": "/tips/1"
    }
  ]
}
"@ | ConvertFrom-Json | ConvertTo-Json
$Action = Invoke-RestMethod -Uri ($Uri + 'mains/' + $ActionId) -ContentType $ContentType -Headers $Headers -Method Put -Body $Body # ConvertTo-Json | ConvertFrom-Json -AsHashtable
$Action
