@push('styles')
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <style>
        .node circle {
            fill: #fff;
            stroke: steelblue;
            stroke-width: 3px;
        }

        .node text {
            font: 12px sans-serif;
        }

        .link {
            fill: none;
            stroke: #ccc;
            stroke-width: 2px;
        }

        .container {
            width: 100%;
            height: 600px;
            /* border: 1px solid #ccc; Optional: For visual debugging */
        }

        svg {
            width: 100%;
            height: 100%;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Staff Hierarchy')
    @include('backend.components.breadcrumb')


</div>


@include('backend.components.alert')

<div class="card overflow-hidden p-16">
    <h4 class="mb-0 ml-4"><b>Routeone Staff Hierarchy</b></h4>
    <div class="card-body p-16">
        <div class="container">
            <div id="chart"></div>
        </div>
    </div>

</div>


@endsection

@push('scripts')
<script>
    const hierarchyData = @json($hierarchy);

    // Get the container dimensions
    const container = d3.select(".container");
    const width = container.node().getBoundingClientRect().width;
    const height = 600;

    const svg = d3.select("#chart")
        .append("svg")
        .attr("width", "100%")
        .attr("height", height)
        .append("g")
        .attr("transform", "translate(0, 50)");

    // Create hierarchy from the children of the root node
    const root = d3.hierarchy({
        children: hierarchyData
    }, d => d.children);

    // Remove the root node by starting with its children
    const nodes = root.descendants().slice(1); // Exclude the root node
    const links = root.links().slice(1); // Exclude links to the root node

    const treeLayout = d3.tree().size([width - 100, height - 100]);

    treeLayout(root);

    // Draw links (excluding the root node)
    svg.selectAll(".link")
        .data(links)
        .enter()
        .append("path")
        .attr("class", "link")
        .attr("d", d3.linkVertical()
            .x(d => d.x)
            .y(d => d.y)
        );

    // Draw nodes (excluding the root node)
    const nodeGroups = svg.selectAll(".node")
        .data(nodes)
        .enter()
        .append("g")
        .attr("class", "node")
        .attr("transform", d => `translate(${d.x},${d.y})`);

    nodeGroups.append("circle")
        .attr("r", 10);

    // Add name and position text
    nodeGroups.append("text")
    .attr("dy", d => d.children ? "-1.5em" : "1.5em") // Adjust vertical position
    .attr("x", d => d.children ? -20 : 20) // Adjust horizontal position
    // .attr("text-anchor", d => d.children ? "end" : "start")
    .text(d => `${d.data.name} (${d.data.position})`);

    // Make the visualization responsive
    window.addEventListener("resize", () => {
        const newWidth = container.node().getBoundingClientRect().width;
        svg.attr("width", newWidth);
        treeLayout.size([newWidth - 100, height - 100]);
        treeLayout(root);

        // Update node positions
        nodeGroups.attr("transform", d => `translate(${d.x},${d.y})`);

        // Update link paths
        svg.selectAll(".link")
            .attr("d", d3.linkVertical()
                .x(d => d.x)
                .y(d => d.y)
            );
    });
</script>
@endpush
