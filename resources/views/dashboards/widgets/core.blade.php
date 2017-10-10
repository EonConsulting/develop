@push('custom-scripts')
<script type='text/javascript'>
    $(document).ready(function(){
       var courses = [
            {
                "course_id": "FBN1501",
                "description": "FBN1501 - Business Numerical Skills A"
            },
            {
                "course_id": "FBN1502",
                "description": "FBN1502 - Business Numerical Skills B"
            }
        ];

        var assessment_types = [
            {
                "assessment_type_id": "SA-ALL",
                "assessment": "SA",
                "description": "ALL"
            },
            {
                "assessment_type_id": "SA-MCQ",
                "assessment": "SA",
                "description": "MCQ"
            },
            {
                "assessment_type_id": "SA-VEN",
                "assessment": "SA",
                "description": "Venue Based"
            },
            {
                "assessment_type_id": "SA-POR",
                "assessment": "SA",
                "description": "Portfolio"
            },
            {
                "assessment_type_id": "FA-ALL",
                "assessment": "FA",
                "description": "ALL"
            },
            {
                "assessment_type_id": "FA-ASS1",
                "assessment": "FA",
                "description": "Assignment 1"
            },
            {
                "assessment_type_id": "FA-ASS2",
                "assessment": "FA",
                "description": "Assignment 2"
            },
            {
                "assessment_type_id": "FA-POR",
                "assessment": "FA",
                "description": "Portfolio"
            },
            {
                "assessment_type_id": "FA-SA1",
                "assessment": "FA",
                "description": "Self-Assessment 1"
            },
            {
                "assessment_type_id": "FA-SA2",
                "assessment": "FA",
                "description": "Self-Assessment 2"
            }
        ];

        var results = [
            {
                "course_id": "FBN1501",
                "assessment": "SA",
                "assessment_type_id": "SA-ALL",
                "labels": [],
                "your_results": [0, 49, 65, 80, 56, 45, 0, 0, 0, 0, 0, 0],
                "class_average": [0, 73, 62, 65, 59, 65, 0, 0, 0, 0, 0, 0],
                "your_average": [0, 49.67, 69.75, 59, 56.67, 58.71, 0, 0, 0, 0, 0, 0]
            },
            {
                "course_id": "FBN1501",
                "assessment": "FA",
                "assessment_type_id": "FA-ALL",
                "labels": [],
                "your_results": [0, 59, 65, 60, 56, 45, 0, 0, 0, 0, 0, 0],
                "class_average": [0, 63, 62, 65, 59, 65, 0, 0, 0, 0, 0, 0],
                "your_average": [0, 59.67, 59.75, 59, 56.67, 58.71, 0, 0, 0, 0, 0, 0]
            },
            {
                "course_id": "FBN1502",
                "assessment": "SA",
                "assessment_type_id": "SA-ALL",
                "labels": [],
                "your_results": [0, 0, 0, 0, 0, 0, 71, 59, 76, 62, 63, 0],
                "class_average": [0, 0, 0, 0, 0, 0, 60, 75, 58, 55, 61, 0],
                "your_average": [0, 0, 0, 0, 0, 0, 58.75, 60.67, 60.80, 61, 61.08, 0]
            },
            {
                "course_id": "FBN1502",
                "assessment": "FA",
                "assessment_type_id": "FA-ALL",
                "labels": [],
                "your_results": [0, 0, 0, 0, 0, 0, 51, 59, 76, 62, 63, 0],
                "class_average": [0, 0, 0, 0, 0, 0, 60, 75, 58, 55, 61, 0],
                "your_average": [0, 0, 0, 0, 0, 0, 48.75, 60.67, 60.80, 61, 61.08, 0]
            },
            {
                "course_id": "FBN1501",
                "assessment": "SA",
                "assessment_type_id": "SA-MCQ",
                "labels": ["MCQ1", "MCQ2", "MCQ3", "MCQ4", "MCQ5", "MCQ6"],
                "your_results": [80, 56, 45, 51, 59, 76],
                "class_average": [65, 59, 65, 60, 75, 58],
                "your_average": [60, 76, 75, 71, 79, 76]
            },
            {
                "course_id": "FBN1502",
                "assessment": "SA",
                "assessment_type_id": "SA-MCQ",
                "labels": ["MCQ7", "MCQ8", "MCQ9", "MCQ10", "MCQ11", "MCQ12"],
                "your_results": [60, 62, 55, 71, 59, 76],
                "class_average": [55, 61, 54, 50, 75, 58],
                "your_average": [50, 72, 45, 71, 79, 76]
            },
            {
                "course_id": "FBN1501",
                "assessment": "SA",
                "assessment_type_id": "SA-VEN",
                "labels": ["VEN1", "VEN2"],
                "your_results": [59, 76],
                "class_average": [75, 58],
                "your_average": [79, 76]
            },
            {
                "course_id": "FBN1502",
                "assessment": "SA",
                "assessment_type_id": "SA-VEN",
                "labels": ["VEN3", "VEN4"],
                "your_results": [60, 62],
                "class_average": [55, 61],
                "your_average": [50, 72]
            },
            {
                "course_id": "FBN1501",
                "assessment": "SA",
                "assessment_type_id": "SA-POR",
                "labels": ["POR1", "POR2", "POR3", "POR4"],
                "your_results": [80, 56, 45, 51],
                "class_average": [65, 59, 65, 60],
                "your_average": [60, 76, 75, 71]
            },
            {
                "course_id": "FBN1502",
                "assessment": "SA",
                "assessment_type_id": "SA-POR",
                "labels": ["POR5", "POR6", "POR7", "POR8"],
                "your_results": [51, 50, 80, 64],
                "class_average": [78, 65, 74, 52],
                "your_average": [45, 71, 79, 76]
            },
            {
                "course_id": "FBN1501",
                "assessment": "FA",
                "assessment_type_id": "FA-ASS1",
                "labels": ["Result"],
                "your_results": [80],
                "class_average": [65],
                "your_average": [60]
            },
            {
                "course_id": "FBN1502",
                "assessment": "FA",
                "assessment_type_id": "FA-ASS1",
                "labels": ["Result"],
                "your_results": [58],
                "class_average": [84],
                "your_average": [72]
            },
            {
                "course_id": "FBN1501",
                "assessment": "FA",
                "assessment_type_id": "FA-ASS2",
                "labels": ["Result"],
                "your_results": [60],
                "class_average": [75],
                "your_average": [60]
            },
            {
                "course_id": "FBN1502",
                "assessment": "FA",
                "assessment_type_id": "FA-ASS2",
                "labels": ["Result"],
                "your_results": [79],
                "class_average": [65],
                "your_average": [72]
            },
            {
                "course_id": "FBN1501",
                "assessment": "FA",
                "assessment_type_id": "FA-POR",
                "labels": ["Result"],
                "your_results": [65],
                "class_average": [73],
                "your_average": [69]
            },
            {
                "course_id": "FBN1502",
                "assessment": "FA",
                "assessment_type_id": "FA-POR",
                "labels": ["Result"],
                "your_results": [73],
                "class_average": [85],
                "your_average": [72]
            },
            {
                "course_id": "FBN1501",
                "assessment": "FA",
                "assessment_type_id": "FA-SA1",
                "labels": ["Result"],
                "your_results": [55],
                "class_average": [76],
                "your_average": [61]
            },
            {
                "course_id": "FBN1502",
                "assessment": "FA",
                "assessment_type_id": "FA-SA1",
                "labels": ["Result"],
                "your_results": [63],
                "class_average": [75],
                "your_average": [65]
            },
            {
                "course_id": "FBN1501",
                "assessment": "FA",
                "assessment_type_id": "FA-SA2",
                "labels": ["Result"],
                "your_results": [65],
                "class_average": [64],
                "your_average": [69]
            },
            {
                "course_id": "FBN1502",
                "assessment": "FA",
                "assessment_type_id": "FA-SA2",
                "labels": ["Result"],
                "your_results": [61],
                "class_average": [70],
                "your_average": [85]
            }
        ];

        var progression = [
            {
                "course_id": "FBN1501",
                "progress": {
                    "videos": {
                        "class_progress": [35],
                        "my_progress": [22],
                        "course_timeline": [32]
                    },
                    "ebooks": {
                        "class_progress": [45],
                        "my_progress": [52],
                        "course_timeline": [42]
                    },
                    "articles": {
                        "class_progress": [65],
                        "my_progress": [67],
                        "course_timeline": [60]
                    },
                    "study_guide": {
                        "class_progress": [44],
                        "my_progress": [55],
                        "course_timeline": [45]
                    }
                }
            },
            {
                "course_id": "FBN1502",
                "progress": {
                    "videos": {
                        "class_progress": [22],
                        "my_progress": [32],
                        "course_timeline": [46]
                    },
                    "ebooks": {
                        "class_progress": [33],
                        "my_progress": [29],
                        "course_timeline": [45]
                    },
                    "articles": {
                        "class_progress": [51],
                        "my_progress": [39],
                        "course_timeline": [36]
                    },
                    "study_guide": {
                        "class_progress": [49],
                        "my_progress": [39],
                        "course_timeline": [51]
                    }
                }
            }
        ];
 
    });
    </script>
@endpush