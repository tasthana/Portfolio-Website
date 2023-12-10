cmake_minimum_required(VERSION 3.15)
project(CrowWeb)

set(CMAKE_CXX_STANDARD 11)
set(INCLUDE_PATHS boost_1_83_0 crow/include)

add_executable(CrowWeb main.cpp)

target_include_directories(CrowWeb PUBLIC ${INCLUDE_PATHS})
