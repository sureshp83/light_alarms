@extends("layouts.master")

@section("content")
    <h1>Marketing Tools</h1>
    <a href="{{route("marketing.sales-literature.get")}}"> Sales Literature Request </a>
    <a href="{{route("marketing.custom-brochure.get")}}"> Custom Brochure Request </a>
    <a href="{{route("marketing.display-board.get")}}"> Display Board Request </a>
@endsection
