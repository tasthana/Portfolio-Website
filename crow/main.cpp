#include "crow.h"
#include <fstream>
#include "opencv2.framework/Headers/opencv.hpp"
#include "opencv2.framework"

int main() {
    crow::SimpleApp app;

    // Route to serve the index.html file
    CROW_ROUTE(app, "/")
    ([]() {
        // Read HTML content from file
        std::ifstream t("build/static/index.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        // Return the HTML content directly
        return crow::response(content);
    });

    // Route to serve the resume.html file
    CROW_ROUTE(app, "/resume")
    ([]() {
        std::ifstream t("build/static/resume.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        return crow::response(content);
    });

    // Route to serve the extra.html file
    CROW_ROUTE(app, "/extra")
    ([]() {
        std::ifstream t("build/static/extra.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        return crow::response(content);
    });

    // Route to serve the jobs.html file
    CROW_ROUTE(app, "/jobs")
    ([]() {
        std::ifstream t("static/jobs.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        return crow::response(content);
    });

    CROW_ROUTE(app, "/upload")
    .methods(crow::HTTPMethod::POST)
    ([](const crow::request& req) {
        CROW_LOG_INFO << "Received POST request to /upload";

        // Check if the request has a file attached
        if (!req.has_file("image")) {
            return crow::response(400, "No file uploaded");
        }

        // Get the uploaded file
        const auto& file = req.get_file_data("image");

        // Read the uploaded image using OpenCV
        cv::Mat image = cv::imdecode(cv::Mat(1, file.size, CV_8UC1, file.data), cv::IMREAD_UNCHANGED);

        // Flip the image upside down
        cv::flip(image, image, 0);

        // Encode the manipulated image as a base64 string
        std::vector<uchar> buf;
        cv::imencode(".jpg", image, buf);
        std::string base64Image = crow::base64encode(buf.data(), buf.size());

        // Serve the manipulated image in the response
        return crow::response(200, base64Image, "text/plain");
    });

    // Set the IP address, port, configure to run on multiple threads, and run the app
    app.loglevel(crow::LogLevel::Debug);  // Set log level to Debug
    app.bindaddr("127.0.0.1").port(18080).multithreaded().run();

}

